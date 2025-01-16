<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Waad\Observer\HasObserver;

class Post extends Model
{
    use HasObserver;

    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}