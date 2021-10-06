<?php

namespace Lioneagle\LeUtils\Tests\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Lioneagle\LeUtils\Casts\DateTimeCast;
use Lioneagle\LeUtils\Contracts\Uuidable;
use Lioneagle\LeUtils\Traits\HasUuid;

class Post extends EloquentModel implements Uuidable
{
    use HasUuid;

    protected $fillable = ['name', 'user_id', 'date'];

    protected $casts = [
        'date' => DateTimeCast::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
