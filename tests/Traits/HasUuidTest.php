<?php

namespace Lioneagle\LeUtils\Tests\Traits;

use Lioneagle\LeUtils\Tests\Models\Post;
use Lioneagle\LeUtils\Tests\Models\User;
use Lioneagle\LeUtils\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class HasUuidTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_the_uuid()
    {
        $model = User::create([
            'name' => 'name',
        ]);

        $this->assertTrue(36 === mb_strlen($model->uuid));
    }

    /**
     * @test
     */
    public function it_can_be_queried_statically_by_uuid()
    {
        $model = User::create([
            'name' => 'name',
        ]);

        $queried = User::uuid($model->uuid);

        $this->assertEquals($model->uuid, $queried->uuid);
    }

    /**
     * @test
     */
    public function it_can_be_queried_by_uuid()
    {
        $model = User::create([
            'name' => 'name',
        ]);

        $queried = User::query()->uuid($model->uuid);

        $this->assertEquals($model->uuid, $queried->uuid);
    }

    /**
     * @test
     */
    public function it_can_query_relationships()
    {
        $user = User::first();

        $post = $user->posts()->first();

        $queried = $user->posts()->uuid($post->uuid);

        $this->assertInstanceOf(Post::class, $queried);
        $this->assertEquals($post->uuid, $queried->uuid);
    }
}
