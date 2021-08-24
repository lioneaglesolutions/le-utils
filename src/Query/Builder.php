<?php

namespace Lioneagle\LeUtils\Query;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Lioneagle\LeUtils\Contracts\UuidBuilderInterface;
use Lioneagle\LeUtils\Traits\BuilderUuidScope;

class Builder extends EloquentBuilder implements UuidBuilderInterface
{
    use BuilderUuidScope;
}
