<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Waad\Observer\Attributes\HasObservers;
use Waad\Observer\HasObserver;
use Workbench\Observers\PostObserver;

#[HasObservers(PostObserver::class)]
class PostAttributeObserver extends Model
{
    use HasObserver;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
