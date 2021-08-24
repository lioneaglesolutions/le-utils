<?php

namespace Lioneagle\LeUtils\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Lioneagle\LeUtils\LeUtilsServiceProvider;
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

        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'VendorName\\Skeleton\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        // );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            LeUtilsServiceProvider::class,
        ];
    }

    protected function setUpDatabase(Application $app)
    {
        // Create the table
        $app['db']->connection()->getSchemaBuilder()->create('models', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->timestamps();
        });
    }
}
