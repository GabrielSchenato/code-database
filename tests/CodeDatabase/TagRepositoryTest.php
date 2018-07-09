<?php

namespace CodePress\CodeDatabase\Tests;

use Mockery as m;
use CodePress\CodeDatabase\Repository\TagRepository;
use CodePress\CodeDatabase\Models\Tag;

/**
 * Description of TagTest
 *
 * @author gabriel
 */
class TagRepositoryTest extends AbstractTestCase
{

    /**
     * @var TagRepository 
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new TagRepository();
        $this->createTag();
    }

    public function test_can_model()
    {
        $this->assertEquals(Tag::class, $this->repository->model());
    }

    public function test_can_makemodel()
    {
        $this->repository = new TagRepository();
        $result = $this->repository->makeModel();
        $this->assertInstanceOf(Tag::class, $result);

        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Tag::class, $result);
    }

    public function test_can_make_model_in_constructor()
    {
        $this->repository = new TagRepository();

        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Tag::class, $result);
    }

    public function test_can_list_all_tags()
    {
        $result = $this->repository->all();
        $this->assertCount(3, $result);
    }

    public function test_can_create_tag()
    {
        $result = $this->repository->create([
            'name' => 'Tag 4'
        ]);
        $this->assertInstanceOf(Tag::class, $result);
        $this->assertEquals('Tag 4', $result->name);

        $result = Tag::find(4);
        $this->assertEquals('Tag 4', $result->name);
    }

    public function test_can_update_tag()
    {
        $result = $this->repository->update([
            'name' => 'Tag Atualizada'
                ], 1);
        $this->assertInstanceOf(Tag::class, $result);
        $this->assertEquals('Tag Atualizada', $result->name);

        $result = Tag::find(1);
        $this->assertEquals('Tag Atualizada', $result->name);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_can_update_tag_fail()
    {
        $this->repository->update([
            'name' => 'Tag Atualizada'
                ], 10);
    }

    public function test_can_delete_tag()
    {
        $result = $this->repository->delete(1);
        $tags = Tag::all();
        $this->assertCount(2, $tags);
        $this->assertEquals(true, $result);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_can_delete_tag_fail()
    {
        $this->repository->delete(10);
    }

    public function test_can_find_tag()
    {
        $result = $this->repository->find(1);
        $this->assertInstanceOf(Tag::class, $result);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_can_find_tag_fail()
    {
        $this->repository->find(10);
    }

    public function test_can_find_tags()
    {
        $result = $this->repository->findBy('name', 'Tag 1');
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Tag::class, $result[0]);
        $this->assertEquals('Tag 1', $result[0]->name);

        $result = $this->repository->findBy('name', 'Tag 10');
        $this->assertCount(0, $result);

        $result = $this->repository->findBy('name', 'Tag 1', ['name']);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Tag::class, $result[0]);
    }

    private function createTag()
    {
        Tag::create([
            'name' => 'Tag 1'
        ]);
        Tag::create([
            'name' => 'Tag 2'
        ]);
        Tag::create([
            'name' => 'Tag 3'
        ]);
    }

}
