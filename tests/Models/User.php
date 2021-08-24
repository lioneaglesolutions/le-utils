<?php

namespace Lioneagle\LeUtils\Tests\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lioneagle\LeUtils\Contracts\Uuidable;
use Lioneagle\LeUtils\Traits\HasUuid;

class User extends EloquentModel implements Uuidable
{
    use HasUuid;

    protected $fillable = ['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
