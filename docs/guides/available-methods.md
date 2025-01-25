# Available Observer Methods

Laravel Dynamic Observer supports all standard Laravel model observer methods. Here's a comprehensive list of available methods and their use cases.

## Core Methods

### Creating & Created

```php
public function creating(Model $model)
{
    // Called before a new model is created
    // Perfect for modifying attributes before save
}

public function created(Model $model)
{
    // Called after a new model is created
    // Ideal for additional operations after creation
}
```

### Updating & Updated

```php
public function updating(Model $model)
{
    // Called before an existing model is updated
    // Use for validation or attribute modification
}

public function updated(Model $model)
{
    // Called after an existing model is updated
    // Perfect for triggering additional updates
}
```

### Saving & Saved

```php
public function saving(Model $model)
{
    // Called before any save operation (create or update)
    // Use for common pre-save operations
}

public function saved(Model $model)
{
    // Called after any save operation
    // Ideal for post-save processing
}
```

### Deleting & Deleted

```php
public function deleting(Model $model)
{
    // Called before a model is deleted
    // Perfect for cleanup operations
}

public function deleted(Model $model)
{
    // Called after a model is deleted
    // Use for post-deletion tasks
}
```

### Soft Deletes

```php
public function restoring(Model $model)
{
    // Called before restoring a soft-deleted model
}

public function restored(Model $model)
{
    // Called after a soft-deleted model is restored
}
```

### Retrieved

```php
public function retrieved(Model $model)
{
    // Called after a model is retrieved from the database
    // Perfect for logging or view counting
}
```

## Best Practices

1. Keep observer methods focused and single-purpose
2. Avoid heavy operations in frequently called methods
3. Use queued jobs for time-consuming tasks
4. Handle exceptions appropriately
5. Document your observer methods 