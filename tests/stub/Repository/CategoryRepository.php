<?php

namespace CodePress\CodeDatabase\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Models\Category;

/**
 * Description of CategoryRepository
 *
 * @author gabriel
 */
class CategoryRepository extends AbstractRepository
{
  

    public function find(int $id, $colums = array('*'))
    {
        
    }

    public function findBy($field, $value, $colums = array('*'))
    {
        
    }
    
    public function model()
    {
        return Category::class;
    }

}
