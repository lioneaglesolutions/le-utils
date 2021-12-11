<?php

namespace Lioneagle\LeUtils;

use Illuminate\Support\ServiceProvider;
use Lioneagle\LeUtils\Commands\IdeHelperCommand;

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
