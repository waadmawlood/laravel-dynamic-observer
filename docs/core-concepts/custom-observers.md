# Custom Observers

Custom observers allow you to define specific observation logic for your models. This guide will show you how to create and implement custom observers with the Laravel Dynamic Observer package.

## Creating a Custom Observer

Create an observer class following standard Laravel conventions:

```php
<?php

namespace App\Observers;

use App\Models\Post;

class CustomPostObserver
{
    public function creating(Post $post)
    {
        $post->slug = \Str::slug($post->title);
    }

    public function updating(Post $post)
    {
        $post->updated_by = auth()->id();
    }
}
```

## Using Custom Observers

To use your custom observer, specify it in your model using the `$observer` property:

```php
<?php

namespace App\Models;

use App\Observers\CustomPostObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = CustomPostObserver::class;
}
```

## Available Methods

Custom observers can implement any of the standard Laravel model events:

- creating
- created
- updating
- updated
- deleting
- deleted
- saving
- saved
- restoring
- restored
- retrieved
- replicating

## Benefits of Custom Observers

- **Organized Code**: Keep your model-related logic organized and maintainable
- **Reusability**: Share common observation logic across multiple models
- **Flexibility**: Easily switch between different observers as needed
- **Testing**: Isolate and test your observation logic independently

## Example Use Cases

1. **Audit Logging**:
```php
class AuditObserver
{
    public function saved($model)
    {
        AuditLog::create([
            'model' => get_class($model),
            'action' => 'saved',
            'user_id' => auth()->id(),
            'changes' => $model->getChanges()
        ]);
    }
}
```

2. **Automatic Slug Generation**:
```php
class SlugObserver
{
    public function creating($model)
    {
        if (isset($model->title)) {
            $model->slug = \Str::slug($model->title);
        }
    }
}
```

## Best Practices

1. Keep observers focused on a single responsibility
2. Use dependency injection when needed
3. Avoid heavy processing in observers
4. Consider using queued observers for resource-intensive operations
5. Document your custom observers thoroughly

Remember that custom observers are a powerful way to encapsulate model-related logic and keep your code clean and maintainable.