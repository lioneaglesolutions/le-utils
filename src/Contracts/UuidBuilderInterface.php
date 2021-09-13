<?php

namespace Lioneagle\LeUtils\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UuidBuilderInterface
{
    /**
     * @return null|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static|static[]
     */
    public function uuid(string $uuid): ?Model;

    /**
     * @return null|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static|static[]
     */
    public function uuidOrFail(string $uuid): ?Model;
}
