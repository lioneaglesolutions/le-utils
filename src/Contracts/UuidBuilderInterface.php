<?php

namespace Lioneagle\LeUtils\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of \Illuminate\Database\Eloquent\Model
 */
interface UuidBuilderInterface
{
    /**
     * @return null|TModelClass
     */
    public function uuid(string $uuid);

    /**
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return TModelClass
     */
    public function uuidOrFail(string $uuid);
}
