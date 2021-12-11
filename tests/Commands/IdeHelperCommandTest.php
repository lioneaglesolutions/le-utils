<?php

namespace Lioneagle\LeUtils\Tests\Commands;

use Illuminate\Console\GeneratorCommand;
use Mockery;

use Mockery\MockInterface;
use Lioneagle\LeUtils\Tests\TestCase;
use Illuminate\Contracts\Console\Kernel;
use Lioneagle\LeUtils\Commands\IdeHelperCommand;

class IdeHelperCommandTest extends TestCase
{
    /**
     * @test
     */
    public function it_calls_the_helper_command()
    {
        $this->mock(IdeHelperCommand::class . "[call]", function (MockInterface $mock) {
            $this->app[Kernel::class]->registerCommand($mock);

            $mock->shouldReceive('call')->withArgs(['ide-helper:generate'])->once();
        });

        $this->artisan('le:ide -F');
    }

    /**
     * @test
     */
    public function it_calls_the_models_command()
    {
        $this->mock(IdeHelperCommand::class . "[call]", function (MockInterface $mock) {
            $this->app[Kernel::class]->registerCommand($mock);

            $mock->shouldReceive('call')->withArgs(['ide-helper:models', ['--write' => true]])->once();
        });

        $this->artisan('le:ide -M');
    }

    /**
     * @test
     */
    public function it_calls_the_models_interactive_command()
    {
        $this->mock(IdeHelperCommand::class . "[getModels,call,choice]", function (MockInterface $mock) {
            $mock->shouldAllowMockingProtectedMethods();
            
            $this->app[Kernel::class]->registerCommand($mock);

            $mock->shouldReceive('getModels')->andReturn(
                collect([
                    [
                        "model" => "App\Models\User",
                        "file" => "app/Models/User.php",
                        "model_name" => "User"
                    ]
                ])
            );

            $mock->shouldReceive('choice')->andReturn(['User']);


            $mock->shouldReceive('call')->withArgs(['ide-helper:models', ['model' => ['App\Models\User'], '--write' => true]])->once();
        });

        $this->artisan('le:ide -MI');
    }
}
