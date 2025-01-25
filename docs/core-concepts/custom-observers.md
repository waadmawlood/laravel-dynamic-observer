# Custom Observers

Custom observers allow you to define specific observation logic for your models. This guide will show you how to create and implement custom observers with the Laravel Dynamic Observer package.

## Creating a Custom Observer

To create a custom observer, you need to:

1. Create a new class that extends the base observer class
2. Define your observation methods
3. Attach it to your model

Here's an example:

```php
namespace App\Observers;

use App\Models\Post;
use Waad\LaravelDynamicObserver\Observers\BaseObserver;

class CustomPostObserver extends BaseObserver
{
    public function creating(Post $post)
    {
        // Your custom logic before creating a post
        $post->slug = \Str::slug($post->title);
    }

    public function updating(Post $post)
    {
        // Your custom logic before updating a post
        $post->updated_by = auth()->id();
    }
}
```

## Using Custom Observers

To use your custom observer, you need to specify it in your model:

```php
use App\Models\Post;
use App\Observers\CustomPostObserver;
use Waad\LaravelDynamicObserver\HasObserver;

class Post extends Model
{
    use HasObserver;

    protected string $observer = CustomPostObserver::class;
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
- replicating

## Benefits of Custom Observers

- **Organized Code**: Keep your model-related logic organized and maintainable
- **Reusability**: Share common observation logic across multiple models
- **Flexibility**: Easily switch between different observers as needed
- **Testing**: Isolate and test your observation logic independently

## Example Use Cases

1. **Audit Logging**:
```php
class AuditObserver extends BaseObserver
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
class SlugObserver extends BaseObserver
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