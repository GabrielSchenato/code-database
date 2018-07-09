<?php

namespace CodePress\CodeDatabase\Criteria;

use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 * 
 *
 * @author gabriel
 */
class FindByNameAndDescription implements CriteriaInterface
{
    private $name;
    private $description;
    
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('name', $this->name)->where('description', $this->description);
    }

}
