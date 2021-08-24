<?php

namespace Lioneagle\LeUtils\Tests\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Lioneagle\LeUtils\Traits\HasUuid;

class Model extends EloquentModel
{
    use HasUuid;

    protected $fillable = ['name'];
}
