<?php

namespace Lioneagle\LeUtils\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Lioneagle\LeUtils\Tests\Models\Post;
use Lioneagle\LeUtils\Tests\Models\User;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function setUpDatabase(Application $app): void
    {
        $this->createDatabaseTables($app);
    }

    protected function createDatabaseTables(Application $app): void
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    protected function createUsers(): void
    {
        collect(range(1, 50))->each(function ($index) {
            /** @var User $user */
            $user = User::create([
                'name' => "Name - {$index}",
            ]);

            $this->createUserPosts($user);
        });
    }

    protected function createUserPosts(User $user): void
    {
        $posts = collect(range(1, 3))->map(function ($index) {
            return new Post([
                'name' => "Name - {$index}",
            ]);
        })->all();

        $user->posts()->saveMany($posts);
    }
}
