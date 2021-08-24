<?php

namespace Lioneagle\LeUtils\Contracts;

interface Uuidable
{
    /**
     * @param \Illuminate\Database\Query\Builder $query
     */
    public function newEloquentBuilder($query): UuidBuilderInterface;
}
