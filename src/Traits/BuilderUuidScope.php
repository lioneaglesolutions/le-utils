<?php

namespace Lioneagle\LeUtils\Traits;

use Illuminate\Database\Eloquent\Model;

trait BuilderUuidScope
{
    /**
     * @param string $uuid
     */
    public function uuid($uuid): ?Model
    {
        return $this->where('uuid', $uuid)->first();
    }
}
