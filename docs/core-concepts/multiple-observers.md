# Multiple Observers

Laravel Dynamic Observer supports attaching multiple observers to a single model, allowing you to organize your model's lifecycle events into separate, focused observers.

## Configuration

To use multiple observers, define the `$observer` property as an array in your model:

```php
<?php

namespace App\Models;

use App\Observers\PostStatsObserver;
use App\Observers\PostNotificationObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = [
        PostStatsObserver::class,
        PostNotificationObserver::class
    ];
}
```

## Example Implementation

### Statistics Observer

```php
<?php

namespace App\Observers;

use App\Models\Post;

class PostStatsObserver
{
    public function created(Post $post)
    {
        // Update creation statistics
    }

    public function retrieved(Post $post)
    {
        // Track view count
        $post->increment('views');
    }
}
```

### Notification Observer

```php
<?php

namespace App\Observers;

use App\Models\Post;

class PostNotificationObserver
{
    public function created(Post $post)
    {
        // Send notifications to followers
    }

    public function updated(Post $post)
    {
        // Notify about updates
    }
}
```

## Execution Order

Observers are executed in the order they are defined in the `$observer` array. Each observer's corresponding method will be called sequentially.

## Best Practices

1. Separate concerns into different observers
2. Keep observers focused on specific functionality
3. Use meaningful observer names
4. Document the purpose of each observer
5. Consider the execution order when defining multiple observers 