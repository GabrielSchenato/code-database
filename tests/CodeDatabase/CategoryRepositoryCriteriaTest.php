<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\Repository\CategoryRepository;
use CodePress\CodeDatabase\Models\Category;
use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Criteria\FindByNameAndDescription;
use CodePress\CodeDatabase\Criteria\FindByDescription;
use CodePress\CodeDatabase\Criteria\OrderDescByName;
use CodePress\CodeDatabase\Criteria\FindByName;

/**
 * Description of CategoryTest
 *
 * @author gabriel
 */
class CategoryRepositoryCriteriaTest extends AbstractTestCase
{

    /**
     * @var CategoryRepository 
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new CategoryRepository();
        $this->createCategory();
    }

    public function test_if_instanceof_criteriacollection()
    {
        $this->assertInstanceOf(CriteriaCollectionInterface::class, $this->repository);
    }

    public function test_can_get_criteriacollection()
    {
        $result = $this->repository->getCriteriaCollection();
        $this->assertCount(0, $result);
    }

    public function test_can_add_criteria()
    {
        $mockCriteria = m::mock(CriteriaInterface::class);
        $result = $this->repository->addCriteria($mockCriteria);
        $this->assertInstanceOf(CategoryRepository::class, $result);
        $this->assertCount(1, $this->repository->getCriteriaCollection());
    }

    public function test_can_getbycriteria()
    {
        $criteria = new FindByNameAndDescription('Category 1', 'Description 1');
        $repository = $this->repository->getByCriteria($criteria);
        $this->assertInstanceOf(CategoryRepository::class, $repository);

        $result = $repository->all();
        $this->assertCount(1, $result);
        $result = $result->first();
        $this->assertEquals($result->name, 'Category 1');
        $this->assertEquals($result->description, 'Description 1');
    }

    public function test_can_applycriteria()
    {
        $this->createCategoryDescription();
        
        $criteria1 = new FindByDescription('Description');
        $criteria2 = new OrderDescByName();

        $this->repository
                ->addCriteria($criteria1)
                ->addCriteria($criteria2);
        $repository = $this->repository->applyCriteria();
        $this->assertInstanceOf(CategoryRepository::class, $repository);

        $result = $repository->all();
        $this->assertCount(2, $result);
        $this->assertEquals($result[0]->name, 'Category Um');
        $this->assertEquals($result[1]->name, 'Category Dois');
    }

    public function test_can_list_all_categories_with_criteria()
    {
        $this->createCategoryDescription();
        
        $criteria1 = new FindByDescription('Description');
        $criteria2 = new OrderDescByName();
        
        $this->repository
                ->addCriteria($criteria1)
                ->addCriteria($criteria2);
        $result = $this->repository->all();
        $this->assertCount(2, $result);
        $this->assertEquals($result[0]->name, 'Category Um');
        $this->assertEquals($result[1]->name, 'Category Dois');
    }
    
    /**
     *  @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_can_find_category_with_criteria_and_exception()
    {
        $this->createCategoryDescription();
        
        $criteria1 = new FindByDescription('Description');
        $criteria2 = new FindByName('Category Dois');
        
        $this->repository
                ->addCriteria($criteria1)
                ->addCriteria($criteria2);
        $this->repository->find(5);
    }

    public function test_can_find_category_with_criteria()
    {
        $this->createCategoryDescription();
        
        $criteria1 = new FindByDescription('Description');
        $criteria2 = new FindByName('Category Um');
        
        $this->repository
                ->addCriteria($criteria1)
                ->addCriteria($criteria2);
        $result = $this->repository->find(5);
        $this->assertEquals($result->name, 'Category Um');
    }

    private function createCategoryDescription()
    {
        Category::create([
            'name' => 'Category Dois',
            'description' => 'Description'
        ]);
        Category::create([
            'name' => 'Category Um',
            'description' => 'Description'
        ]);
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
