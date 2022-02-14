<?php

namespace Lioneagle\LeUtils\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateTimeCast implements CastsAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed                               $value
     *
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public function get($model, string $key, $value, array $attributes): ?Carbon
    {
        return $value ? Carbon::parse($value) : null;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Carbon\Carbon|string               $value
     *
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    public function set($model, string $key, $value, array $attributes): ?Carbon
    {
        if ($value === null) {
            return null;
        }
        
        if (is_string($value)) {
            $value = Carbon::parse($value);
        }

        $value->setTimezone(config('app.timezone'));

        return $value;
    }
}
