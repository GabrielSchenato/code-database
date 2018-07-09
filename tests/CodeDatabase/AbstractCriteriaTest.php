<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepository;
use CodePress\CodeDatabase\Models\Category;
use Illuminate\Database\Query\Builder;

/**
 * Description of AbstractCriteriaTest
 *
 * @author gabriel
 */
class AbstractCriteriaTest extends AbstractTestCase
{

    public function test_should_apply()
    {
        $mockQueryBuilder = m::mock(Builder::class);
        $mockRepository = m::mock(CategoryRepository::class);
        $mockModel = m::mock(Category::class);
        $mock = m::mock(AbstractCriteria::class);
        $mock->shouldReceive('apply')
                ->with($mockModel, $mockRepository)
                ->andReturn($mockQueryBuilder);
        
        $this->assertInstanceOf(Builder::class, $mock->apply($mockModel, $mockRepository));
    }

}
