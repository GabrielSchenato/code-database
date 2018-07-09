<?php

namespace CodePress\CodeDatabase\Criteria;

use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 * 
 *
 * @author gabriel
 */
class FindByName implements CriteriaInterface
{
    private $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('name', $this->name);
    }

}
