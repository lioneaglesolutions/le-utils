<?php

namespace Lioneagle\LeUtils\Tests\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Support\Facades\Hash;

class Password implements CastsInboundAttributes
{
    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $key
     * @param mixed                               $value
     * @param array                               $attributes
     *
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return Hash::make($value);
    }
}
