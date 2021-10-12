<?php

namespace Lioneagle\LeUtils\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lioneagle\LeUtils\Casts\PasswordCast;
use Lioneagle\LeUtils\Contracts\Uuidable;
use Lioneagle\LeUtils\Traits\HasUuid;

class User extends Model implements Uuidable
{
    use HasUuid;

    protected $fillable = ['name', 'password'];

    protected $casts = [
        'password' => PasswordCast::class,
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
