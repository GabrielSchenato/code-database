<?php

namespace CodePress\CodeDatabase;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\CriteriaInterface;

/**
 * Description of AbstracRepository
 *
 * @author gabriel
 */
abstract class AbstractRepository implements RepositoryInterface, CriteriaCollectionInterface
{

    protected $model;
    protected $criteriaCollection = [];
    protected $isIgnoreCriteria = false;

    public function __construct()
    {
        $this->makeModel();
    }

    public abstract function model();

    public function makeModel()
    {
        $class = $this->model();
        $this->model = new $class;
        return $this->model;
    }

    public function all($colums = array('*'))
    {
        $this->applyCriteria();
        return $this->model->get($colums);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function find(int $id, $colums = array('*'))
    {
        $this->applyCriteria();
        return $this->model->findOrFail($id, $colums);
    }

    public function findBy($field, $value, $colums = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($field, '=', $value)->get($colums);
    }

    public function deleted($colums = array('*'))
    {
        $this->applyCriteria();
        return $this->model->onlyTrashed()->get($colums);
    }

    public function restore(int $id)
    {
        $this->applyCriteria();
        $model = $this->findWithTrashed($id);
        return $model->restore();
    }

    public function findWithTrashed(int $id, $colums = array('*'))
    {
        $this->applyCriteria();
        return $this->model->withTrashed()->find($id, $colums);
    }

    public function addCriteria(CriteriaInterface $criteria)
    {
        $this->criteriaCollection[] = $criteria;
        return $this;
    }

    public function getCriteriaCollection()
    {
        return $this->criteriaCollection;
    }

    public function getByCriteria(CriteriaInterface $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function applyCriteria()
    {
        if ($this->isIgnoreCriteria) {
            return $this;
        }

        foreach ($this->getCriteriaCollection() as $criteria) {
            $this->model = $criteria->apply($this->model, $this);
        }
        return $this;
    }

    public function ignoreCriteria(bool $isIgnore = true)
    {
        $this->isIgnoreCriteria = $isIgnore;
        return $this;
    }

    public function clearCriteria()
    {
        $this->criteriaCollection = [];
        $this->makeModel();
        return $this;
    }

}
