<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function test_should_return_all_without_arguments()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);
        $mockStd->id = 1;
        $mockStd->name = 'name';
        $mockStd->description = 'description';

        $mockRepository
                ->shouldReceive('all')
                ->andReturn([$mockStd, $mockStd, $mockStd]);
        $this->assertCount(3, $mockRepository->all());
        $this->assertInstanceOf(\stdClass::class, $mockRepository->all()[0]);
    }
    
    public function test_should_return_all_with_arguments()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);
        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
                ->shouldReceive('all')
                ->with(['id', 'name'])
                ->andReturn([$mockStd, $mockStd, $mockStd]);
        $this->assertCount(3, $mockRepository->all(['id', 'name']));
        $this->assertInstanceOf(\stdClass::class, $mockRepository->all(['id', 'name'])[0]);
    }
    
    public function test_should_return_create()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);
        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
                ->shouldReceive('create')
                ->with(['name' => 'stdClassName'])
                ->andReturn($mockStd);
        
        $result = $mockRepository->create(['name' => 'stdClassName']);
        
        $this->assertEquals(1, $result->id);
        $this->assertInstanceOf(\stdClass::class, $result);
    }
    
    public function test_should_return_update_success()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);
        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
                ->shouldReceive('update')
                ->with(['name' => 'stdClassName'], 1)
                ->andReturn($mockStd);
        
        $result = $mockRepository->update(['name' => 'stdClassName'], 1);
        
        $this->assertEquals(1, $result->id);
        $this->assertInstanceOf(\stdClass::class, $result);
    }
    
    /**
     *  @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */    
    public function test_should_update_fail()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $throw = new ModelNotFoundException();
        $throw->setModel(\stdClass::class);
        
        $mockRepository
                ->shouldReceive('update')
                ->with(['name' => 'stdClassName'], 0)
                ->andThrow($throw);
        
        $mockRepository->update(['name' => 'stdClassName'], 0);
    }

}
