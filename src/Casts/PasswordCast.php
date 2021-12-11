<?php

namespace Lioneagle\LeUtils\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Support\Facades\Hash;

class PasswordCast implements CastsInboundAttributes
{
    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed                               $value
     *
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        return Hash::make($value);
    }
}
