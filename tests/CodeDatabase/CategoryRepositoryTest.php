<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CodePress\CodeDatabase\Models\Category;

/**
 * Description of CategoryTest
 *
 * @author gabriel
 */
class CategoryRepositoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }
    
    public function test_can_model()
    {
        $repository = new CategoryRepository();
        $this->assertEquals(Category::class, $repository->model());
    }
    
    public function test_can_makemodel()
    {
        $repository = new CategoryRepository();
        $repository->makeModel();
        $reflectionClass = new \ReflectionClass($repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);
        
        $this->assertInstanceOf(Category::class, $reflectionProperty->getValue($repository));
    }

}
