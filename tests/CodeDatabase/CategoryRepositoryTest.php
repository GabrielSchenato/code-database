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
    private $repository;
    
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new CategoryRepository();
        $this->createCategory();
    }
    
    public function test_can_model()
    {
        $this->assertEquals(Category::class, $this->repository->model());
    }
    
    public function test_can_makemodel()
    {
        $this->repository = new CategoryRepository();
        $result = $this->repository->makeModel();
        $this->assertInstanceOf(Category::class, $result);
        
        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);
        
        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Category::class, $result);
    }
    
    public function test_can_make_model_in_constructor()
    {
        $this->repository = new CategoryRepository();
        
        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);
        
        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Category::class, $result);
    }
    
    private function createCategory()
    {
        Category::create([
            'name' => 'Category 1',
            'description' => 'Description 1'
        ]);
        Category::create([
            'name' => 'Category 2',
            'description' => 'Description 2'
        ]);
        Category::create([
            'name' => 'Category 3',
            'description' => 'Description 3'
        ]);
    }

}
