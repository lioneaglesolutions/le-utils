<?php

namespace Lioneagle\LeUtils\Tests\Traits;

use Lioneagle\LeUtils\Tests\Models\Model;
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
        $model = Model::create([
            'name' => 'name',
        ]);

        $this->assertTrue(36 === mb_strlen($model->uuid));
    }

    /**
     * @test
     */
    public function it_can_be_queried_statically_by_uuid()
    {
        $model = Model::create([
            'name' => 'name',
        ]);

        $queried = Model::uuid($model->uuid);

        $this->assertEquals($model->uuid, $queried->uuid);
    }
}
