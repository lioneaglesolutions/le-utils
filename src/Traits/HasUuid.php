<?php

namespace Lioneagle\LeUtils\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Lioneagle\LeUtils\Contracts\UuidBuilderInterface;
use Lioneagle\LeUtils\Query\Builder;

/**
 * @property string $uuid;
 */
trait HasUuid
{
    /**
     * Add UUID to model upon creation.
     */
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model) {
            $model->uuid = Str::orderedUuid()->toString();
        });
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Lioneagle\LeUtils\Query\Builder<static>
     */
    public function newEloquentBuilder($query): UuidBuilderInterface
    {
        return new Builder($query);
    }

    /**
     * Add 'id' to the $hidden attributes.
     */
    public function initializeHasUuid(): void
    {
        $this->hidden[] = 'id';
    }
}
