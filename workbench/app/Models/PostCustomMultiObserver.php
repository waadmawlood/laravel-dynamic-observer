<?php

namespace Workbench\App\Models;

use Workbench\App\Observers\CustomObserver1;
use Workbench\App\Observers\CustomObserver2;

class PostCustomMultiObserver extends Post
{
    protected $table = 'posts';
    public static $observer = [CustomObserver1::class, CustomObserver2::class];
}