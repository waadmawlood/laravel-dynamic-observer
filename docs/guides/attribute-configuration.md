# Attribute-Based Configuration

Laravel Dynamic Observer supports PHP 8.0+ attributes for configuring observers on your models. This provides a clean, declarative way to specify observers.

## Basic Usage

Use the `#[HasObservers]` attribute to specify an observer class:

```php
<?php

namespace App\Models;

use App\Observers\CustomObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\Attributes\HasObservers;
use Waad\Observer\HasObserver;

#[HasObservers(CustomObserver::class)]
class Post extends Model
{
    use HasObserver;
}
```

> **Important:** When using the attribute, you must also use the `HasObserver` trait.

## Multiple Observers

You can specify multiple observers using an array:

```php
<?php

namespace App\Models;

use App\Observers\FirstObserver;
use App\Observers\SecondObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\Attributes\HasObservers;
use Waad\Observer\HasObserver;

#[HasObservers([FirstObserver::class, SecondObserver::class])]
class Post extends Model
{
    use HasObserver;
}
```

## Comparison: Trait Property vs Attribute

### Using Trait Property
```php
use App\Observers\CustomObserver;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = CustomObserver::class;
}
```

### Using Attribute
```php
use App\Observers\CustomObserver;
use Waad\Observer\Attributes\HasObservers;
use Waad\Observer\HasObserver;

#[HasObservers(CustomObserver::class)]
class Post extends Model
{
    use HasObserver;
}
```

## Priority

When both the attribute and the `$observer` property are defined, the attribute takes precedence.

## Benefits of Attributes

- **Type-safe**: Full IDE support and type checking
- ** Declarative**: Clear intent at the top of your model class
- **Modern**: Uses PHP 8.0+ features
- **Consistent**: Same syntax for single and multiple observers