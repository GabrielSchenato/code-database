<?php

namespace CodePress\CodeDatabase\Contracts;

/**
 *
 * @author gabriel
 */
interface CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository);
}
