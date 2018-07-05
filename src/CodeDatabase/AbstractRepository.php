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
    public abstract function model();
}
