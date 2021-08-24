<?php

namespace Lioneagle\LeUtils\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UuidBuilderInterface
{
    public function uuid(string $uuid): ?Model;
}
