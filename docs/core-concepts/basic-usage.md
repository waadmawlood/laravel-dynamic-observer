# Basic Usage

Laravel Dynamic Observer provides a simple and intuitive way to implement model observers in your Laravel application. [github-laravel-dynamic-observer](https://github.com/waadmawlood/laravel-dynamic-observer)

## Adding the Trait

The first step is to add the `HasObserver` trait to your model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;
}
```

## Creating an Observer

Create a new observer using Laravel's artisan command:

```bash
php artisan make:observer PostObserver --model=Post
```

The observer will be created in `app/Observers/PostObserver.php`:

```php
<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        // Handle the Post "created" event
    }

    public function updated(Post $post)
    {
        // Handle the Post "updated" event
    }

    // Add more observer methods as needed
}
```

## How It Works

The `HasObserver` trait automatically:

1. Detects the model name
2. Looks for a corresponding observer in the `App\Observers` namespace
3. Registers the observer with your model

No additional configuration or service provider registration is required! 