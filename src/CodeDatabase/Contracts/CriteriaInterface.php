<?php

namespace CodePress\CodeDatabase\Contracts;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 *
 * @author gabriel
 */
interface CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository);
}
