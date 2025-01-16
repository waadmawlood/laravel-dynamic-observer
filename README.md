
# 🎀 Laravel Dynamic Observer 

Call observer of the model from the direct model by trait `HasObserver` without requiring any provider, support multi observers.

## 📋 Requirements

- PHP 7.3 or higher
- Laravel 6.0 or higher


## 💼 Installation
Require this package with composer using the following command:

```bash
composer require waad/laravel-dynamic-observer
```


&nbsp;
___

## 💯 Usage

To properly use this package, follow the steps that meet your needs

- 🟢 will connect dynamically with an observer named `WorksObserver` in `App\Observers` namespace 

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Work extends Model
{
    use HasObserver;  // ---> add this trait to connect with observer


    ......
}
```

&nbsp;

- 🟢 if using custom observer different name class use `$observer` property

```php
<?php

namespace App\Models;

use App\Observers\MyWorkObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Work extends Model
{
    use HasObserver;

    // add this property to connect with observer custom name class
    public static $observer = MyWorkObserver::class;
}
```

&nbsp;

- 🟢 if using multi observer different names classes used `$observer` property

```php
<?php

namespace App\Models;

use App\Observers\MyWorkObserver;
use App\Observers\OurWorkObserver;
use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Work extends Model
{
    use HasObserver;

    // add this property to connect with multi observer custom name class
    public static $observer = [MyWorkObserver::class, OurWorkObserver::class];
}
```

&nbsp;
___

## 🍔 Example Obsever

- to create an observer use this command replace `{YourModel}` with your model name
```bash
php artisan make:observer {YourModel}Observer --model={YourModel}
```

&nbsp;
&nbsp;

🔥🔥🔥 The following example shows all available observer methods. You can copy any needed methods to your generated observer file:
```php
<?php

namespace App\Observers;

use App\Models\Work;

class WorkObserver
{
    
    public function creating(Work $work)
    {
        // This function is called when a new model instance is being created.
        $work->title = $work->title . ".....";
    }

    public function created(Work $work)
    {
        // This function is called after a new model instance is successfully 
        // created and saved to the database.

        $work->users()->attach([1,2]);
    }

    public function updating(Work $work)
    {
        // This function is called when an existing model instance is being updated.

        $work->status_color = $work->status ? 'green' : 'red';
    }

    public function updated(Work $work)
    {
        // This function is called after an existing model instance is successfully 
        // updated and saved to the database.

        $work->users()->sync([1,3]);
    }

    public function saving(Work $work)
    {
        // This function is called when a model instance is being saved
        // (either created or updated).

        $work->title = $work->title . ".....";
    }

    public function saved(Work $work)
    {
        // This function is called after a model instance is successfully saved 
        // (either created or updated).

        $work->status_string = 'working';
        $work->save();
    }

    public function deleting(Work $work)
    {
        // This function is called when an existing model instance is being deleted.

        $work->users()->detach();
    }

    public function deleted(Work $work)
    {
        // This function is called after an existing model instance is successfully deleted 
    }

    public function restoring(Work $work)
    {
        // This function is called when a "soft-deleted" model instance is being restored.
    }

    public function restored(Work $work)
    {
        // This function is called after a "soft-deleted" model instance is successfully restored.
    }

    public function retrieved(Work $work)
    {
        // This function is called after a model instance is retrieved from the database.

        $work->increment('views');
    }
}
```
___

## 🧪 Testing

You can run the test suite using the following command:

```bash
composer test
```
___

## 🚀 About Me
I'm a developer ...

- Author :[ Waad Mawlood](https://waad.netlify.app/)

- Email  : waad_mawlood@outlook.com

___

## ⚖️ License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
