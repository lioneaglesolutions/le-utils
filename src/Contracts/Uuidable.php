<?php

namespace Lioneagle\LeUtils\Contracts;

interface Uuidable
{
    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Lioneagle\LeUtils\Contracts\UuidBuilderInterface<static>
     */
    public function newEloquentBuilder($query): UuidBuilderInterface;
}
