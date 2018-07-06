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

    public function model()
    {
        return Category::class;
    }

}
