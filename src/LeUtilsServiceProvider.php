<?php

namespace Lioneagle\LeUtils;

use App\Commands\IdeHelperCommand;
use Illuminate\Support\ServiceProvider;

class LeUtilsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    protected function bootForConsole()
    {
        $this->commands([
            IdeHelperCommand::class
        ]);
    }
}
