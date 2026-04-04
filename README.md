# Laravel Dynamic Observer

> Register model observers dynamically without service providers. Supports single and multiple observers.

Automatically connect your Laravel models to observers using traits or attributes — no service provider required.

---

## Features

- Automatic observer registration via trait
- Custom observer support with `$observer` property
- Multiple observers support
- PHP 8.0+ attribute-based configuration
- Zero configuration needed for convention-based observers

---

## Requirements

- PHP 8.0+
- Laravel 8.0+

---

## Installation

```bash
composer require waad/laravel-dynamic-observer
```

---

## Quick Start

Add the `HasObserver` trait to your model:

```php
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;
}
```

The observer will beauto-detected based on naming convention (`PostObserver` in `App\Observers`).

---

## Usage

### 1. Automatic Observer (Convention-Based)

The observer is automatically detected by naming convention:

```php
// App\Models\Post → App\Observers\PostObserver
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;
}
```

### 2. Custom Observer

Specify a custom observer class:

```php
use App\Observers\CustomObserver;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = CustomObserver::class;
}
```

### 3. Multiple Observers

Register multiple observers:

```php
use App\Observers\FirstObserver;
use App\Observers\SecondObserver;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = [FirstObserver::class, SecondObserver::class];
}
```

### 4. Using Attributes (PHP 8.0+)

Use the `#[HasObservers]` attribute:

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

> **Note:** When using the attribute, you must also use the trait `HasObserver`.

---

## Creating Observers

Generate an observer with Artisan:

```bash
php artisan make:observer PostObserver --model=Post
```

### Observer Methods

```php
namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        // Called before creating
    }

    public function created(Post $post)
    {
        // Called after creating
    }

    public function updating(Post $post)
    {
        // Called before updating
    }

    public function updated(Post $post)
    {
        // Called after updating
    }

    public function saving(Post $post)
    {
        // Called before saving (create or update)
    }

    public function saved(Post $post)
    {
        // Called after saving
    }

    public function deleting(Post $post)
    {
        // Called before deleting
    }

    public function deleted(Post $post)
    {
        // Called after deleting
    }

    public function restoring(Post $post)
    {
        // Called before restoring (soft deletes)
    }

    public function restored(Post $post)
    {
        // Called after restoring
    }

    public function retrieved(Post $post)
    {
        // Called after retrieving
    }
}
```

---

## Testing

```bash
composer test
```

---

## License

MIT License. See [LICENSE](LICENSE) for details.