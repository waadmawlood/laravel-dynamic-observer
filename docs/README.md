# Laravel Dynamic Observer

> Elegantly manage Laravel model observers with zero configuration

[GitHub](https://github.com/waadmawlood/laravel-dynamic-observer)


Laravel Dynamic Observer is a powerful package that simplifies the implementation of model observers in your Laravel applications. It allows you to connect observers to models using a simple trait, without requiring any service provider registration.

## Key Features

- 🚀 Zero configuration required
- 🎯 Convention-based observer binding
- 🔄 Support for multiple observers
- 🛠 Custom observer class naming
- ⚡️ Dynamic observer registration
- 🔍 Transparent implementation
- 📦 Minimal overhead

## Quick Example

```php
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;  // That's it! Your model is now observable
}
```

## Why Laravel Dynamic Observer?

Traditional Laravel observer implementation requires manual registration in service providers. This package eliminates that boilerplate by automatically connecting your models with their respective observers through a simple trait.

Whether you're building a small application or a large-scale system, Laravel Dynamic Observer helps you maintain clean, organized code while following Laravel's best practices. 