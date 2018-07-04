<?php

namespace CodePress\CodeDatabase\Contracts;

/**
 *
 * @author gabriel
 */
interface RepositoryInterface
{

    public function all($colums = array('*'));

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id, $colums = array('*'));

    public function findBy($field, $value, $colums = array('*'));
}
