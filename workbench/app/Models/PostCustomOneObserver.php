<?php

namespace Workbench\App\Models;

use Workbench\App\Observers\CustomObserver1;

class PostCustomOneObserver extends Post
{
    protected $table = 'posts';
    public static $observer = CustomObserver1::class;
}