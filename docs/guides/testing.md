# Testing

Laravel Dynamic Observer comes with tests to ensure the package works correctly. Here's how to run tests and what they cover.

## Running Tests

Run the test suite using Composer:

```bash
composer test
```

## Test Coverage

The package includes tests for:

- **Basic Usage**: Convention-based observer detection
- **Custom Observer**: Single custom observer via `$observer` property
- **Multiple Observers**: Array of observers
- **Attribute-Based**: PHP 8.0+ attribute configuration

## Example Test Cases

### Basic Observer Detection

```php
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;
}

// Automatically detects App\Observers\PostObserver
```

### Custom Observer

```php
use App\Observers\CustomObserver;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    public static $observer = CustomObserver::class;
}
```

### Multiple Observers

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

### Attribute Configuration

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

## Writing Tests for Your Observers

When testing models that use the `HasObserver` trait, you can mock or swap observers:

```php
use App\Models\Post;
use App\Observers\PostObserver;

$post = new Post(['title' => 'Test']);

// Test your model behavior
```

The package uses Pest PHP for testing. See the `tests/` directory for the full test suite.