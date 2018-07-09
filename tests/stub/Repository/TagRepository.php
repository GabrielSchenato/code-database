<?php

namespace CodePress\CodeDatabase\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Models\Tag;

/**
 * Description of TagRepository
 *
 * @author gabriel
 */
class TagRepository extends AbstractRepository
{

    public function model()
    {
        return Tag::class;
    }

}
