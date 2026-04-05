<?php

namespace Workbench\Observers;

use Illuminate\Database\Eloquent\Model;
use Workbench\App\Models\Post;

class PostObserver
{
    public function creating(Model $model)
    {
        $model->title = $model->title.'.observer';
    }

    public function created(Model $model)
    {
        $model->status = ! $model->status;
        $model->saveQuietly();
    }

    public function updating(Model $model)
    {
        $model->content = $model->content.'@updating';
    }

    public function updated(Model $model)
    {
        $model->status = ! $model->status;
        $model->saveQuietly();
    }

    public function deleting(Model $model)
    {
        config()->set('app.name', 'Observer');
    }

    public function deleted(Model $model)
    {
        $post = new Post;
        $post->title = 'surprise';
        $post->content = 'this ovserver so cool';
        $post->status = true;
        $post->save();
    }
}
