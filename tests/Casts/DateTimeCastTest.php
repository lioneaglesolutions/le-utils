<?php

namespace Lioneagle\LeUtils\Tests\Casts;

use Carbon\Carbon;
use Lioneagle\LeUtils\Tests\Models\Post;
use Lioneagle\LeUtils\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class DateTimeCastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->app->get('config');
        $config->set('app.timezone', 'UTC');
    }

    /**
     * @test
     */
    public function it_sets_the_date_from_a_string()
    {
        $post = $this->createPost([
            'name' => 'Foo Bar - String',
            'date' => '2021-10-05T22:00:00+10:00',
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'Foo Bar - String',
            'date' => '2021-10-05 12:00:00',
        ]);
    }

    /**
     * @test
     */
    public function it_sets_the_date_from_a_carbon_object()
    {
        $now = Carbon::now()->setTimezone('Australia/Brisbane');

        $this->createPost([
            'name' => 'Foo Bar - Carbon',
            'date' => $now,
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'Foo Bar - Carbon',
            'date' => $now->setTimeZone('UTC')->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @test
     */
    public function it_gets_the_time_as_carbon_object_in_app_timezone()
    {
        $now = Carbon::now()->setTimezone('Australia/Brisbane');

        $post = $this->createPost([
            'date' => $now,
        ]);

        $this->assertInstanceOf(Carbon::class, $post->date);
        $this->assertEquals(config('app.timezone'), $post->date->getTimezone());
    }

    /**
     * @test
     */
    public function it_returns_null_if_date_is_null()
    {
        $post = $this->createPost([
            'name' => 'Foo Bar - Carbon',
            'date' => null,
        ]);

        $this->assertNotInstanceOf(Carbon::class, $post->date);
        $this->assertNull($post->date);
    }

    protected function createPost(array $attributes = [])
    {
        $attrs = array_merge([
            'name' => 'New Post',
        ], $attributes);

        return Post::create($attrs);
    }
}
