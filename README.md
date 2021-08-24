# A Utility Package for Laravel

## Installation

---

### Composer

```bash
$ composer require lioneagle/le-utils
```

## UUIDs

---

This package provides utilities to add support for a `uuid` column for Eloquent models

### Usage

In your model, ensure it implements `Lioneagle\LeUtils\Contracts\Uuidable`.

Use the `Lioneagle\LeUtils\Traits\HasUuid` to satisfy this interface by default.

```php
<?php

namespace Lioneagle\LeUtils\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lioneagle\LeUtils\Contracts\Uuidable;
use Lioneagle\LeUtils\Traits\HasUuid;

class User extends Model implements Uuidable
{
    use HasUuid;

    protected $fillable = ['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
```

Now you can query the model statically, or as part of a query;

```php
$uuid = '942e28b5-63e3-4475-8d96-4f04ab0f627f';

$user = User::uuid($uuid);
$user = User::query()->uuid($uuid);
```

You can also query relationships with the `uuid()` method;

```php
$post = User::posts()->uuid($uuid);
```

### Custom Builder

By default, the `HasUuid` trait will create a custom builder that will be return for new queries. The builder returned must implement `Lioneagle\LeUtils\Contracts\UuidBuilderInterface`.

You can return your own builder, but it must implement the same interface. You can use the `Lioneagle\LeUtils\Traits\BuilderUuidScope` trait to implement the required interface method.

```php
<?php

namespace Lioneagle\LeUtils\Query;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Lioneagle\LeUtils\Contracts\UuidBuilderInterface;
use Lioneagle\LeUtils\Traits\BuilderUuidScope;

class CustomBuilder extends EloquentBuilder implements UuidBuilderInterface
{
    use BuilderUuidScope;

    public function whereActive()
    {
        return $this->where('active', 1);
    }
}
```

Then simply return this in your models `newEloquentBuilder` method.

```php
class User extends Model implements Uuidable
{
    use HasUuid;

    protected $fillable = ['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function newEloquentBuilder($query): UuidBuilderInterface
    {
        return new CustomBuilder($query);
    }
}
```
