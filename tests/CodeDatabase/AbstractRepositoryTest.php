<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

/**
 * Description of CategoryTest
 *
 * @author gabriel
 */
class AbstractRepositoryTest extends AbstractTestCase
{

    public function test_if_implements_repository_interface()
    {
        $mock = m::mock(AbstractRepository::class);
        $this->assertInstanceOf(RepositoryInterface::class, $mock);
    }

}
