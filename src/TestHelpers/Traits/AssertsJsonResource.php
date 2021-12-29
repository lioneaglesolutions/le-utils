<?php

namespace Lioneagle\LeUtils\TestHelpers\Traits;

use Illuminate\Testing\TestResponse;

trait AssertsJsonResource
{
    public function registerAssertJsonResourceMacro()
    {
        TestResponse::macro('assertJsonResource', function ($resource) {
            // @var \Illuminate\Testing\TestResponse $this
            return $this->assertExactJson($resource->response(request())->getData(true));
        });
    }
}
