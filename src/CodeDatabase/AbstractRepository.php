<?php

namespace CodePress\CodeDatabase;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 * Description of AbstracRepository
 *
 * @author gabriel
 */
abstract class AbstractRepository implements RepositoryInterface
{

    /**
     *
     * @var \Illuminate\Database\Eloquent\Model 
     */
    protected $model;

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
        return $this->model->findOrFail($id, $colums);
    }
}
