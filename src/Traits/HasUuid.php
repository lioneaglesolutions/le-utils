<?php

namespace Lioneagle\LeUtils\Traits;

use Illuminate\Support\Str;

/**
 * @property string $uuid;
 */
trait HasUuid
{
    /**
     * Add UUID to model upon creation.
     */
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::orderedUuid()->toString();
        });
    }

    public static function uuid(string $uuid): ?static
    {
        return self::where('uuid', $uuid)->first();
    }

    /**
     * Add 'id' to the $hidden attributes.
     */
    public function initializeHasUuid()
    {
        $this->hidden[] = 'id';
    }
}
