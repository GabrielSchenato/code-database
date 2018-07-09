<?php

namespace CodePress\CodeDatabase\Criteria;

use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 * 
 *
 * @author gabriel
 */
class FindByDescription implements CriteriaInterface
{
    private $description;
    
    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('description', $this->description);
    }

}
