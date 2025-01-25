# Installation

Getting started with Laravel Dynamic Observer is straightforward. Follow these simple steps to add the package to your Laravel project. [github-laravel-dynamic-observer](https://github.com/waadmawlood/laravel-dynamic-observer)

## Using Composer

```bash
composer require waad/laravel-dynamic-observer
```

That's it! The package will automatically register itself with Laravel.

## Verification

To verify the installation, you can create a simple model with the `HasObserver` trait:

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

If no errors occur when accessing your model, the package is installed correctly. 