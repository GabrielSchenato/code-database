<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Models\Category;
use Illuminate\Database\Query\Builder;

/**
 * Description of CriteriaInterfaceTest
 *
 * @author gabriel
 */
class CriteriaInterfaceTest extends AbstractTestCase
{

    public function test_should_apply()
    {
        $mockQueryBuilder = m::mock(Builder::class);
        $mockRepository = m::mock(RepositoryInterface::class);
        $mockModel = m::mock(Category::class);
        $mock = m::mock(CriteriaInterface::class);
        $mock->shouldReceive('apply')
                ->with($mockModel, $mockRepository)
                ->andReturn($mockQueryBuilder);

        $this->assertInstanceOf(Builder::class, $mock->apply($mockModel, $mockRepository));
    }

}
