<?php

namespace Lioneagle\LeUtils\TestHelpers\Traits;

use Lioneagle\LeUtils\TestHelpers\ActionSpy;
use Mockery;
use ReflectionClass;
use ReflectionParameter;

/**
 * @mixin \Illuminate\Foundation\Testing\TestCase
 */
trait SpiesOnActions
{
    /**
     * @param  string  $action
     * @return \Lioneagle\LeUtils\TestHelpers\ActionSpy
     * @throws \ReflectionException
     */
    public function spyOnAction(string $action): ActionSpy
    {
        $reflection = new ReflectionClass($action);

        $reflectionArgs = $reflection->getConstructor()?->getParameters() ?: [];

        $args = collect($reflectionArgs)->map(function (ReflectionParameter $parameter) {
            return app($parameter->getType()->getName());
        })->all();

        $mock = Mockery::mock($action, $args)->shouldIgnoreMissing()->makePartial();

        $spy = $this->instance($action, $mock);

        return new ActionSpy($mock);
    }
}
