<?php

namespace Lioneagle\LeUtils\Query;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Lioneagle\LeUtils\Contracts\UuidBuilderInterface;
use Lioneagle\LeUtils\Traits\BuilderUuidScope;

/**
 * @phpstan-template TModelClass of \Illuminate\Database\Eloquent\Model
 * @phpstan-extends Builder<TModelClass>
 */
class Builder extends EloquentBuilder implements UuidBuilderInterface
{
    use BuilderUuidScope;
}
