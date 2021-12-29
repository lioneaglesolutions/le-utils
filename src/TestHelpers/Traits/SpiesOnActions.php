<?php

namespace Lioneagle\LeUtils\TestHelpers\Traits;

use Lioneagle\LeUtils\TestHelpers\ActionSpy;

/**
 * @mixin \Illuminate\Foundation\Testing\TestCase
 */
trait SpiesOnActions
{
    public function spyOnAction(string $action): ActionSpy
    {
        return new ActionSpy($this->spy($action));
    }
}
