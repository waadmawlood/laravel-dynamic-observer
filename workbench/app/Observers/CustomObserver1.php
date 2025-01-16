<?php

namespace Workbench\App\Observers;

use Illuminate\Database\Eloquent\Model;

class CustomObserver1
{
    public function creating(Model $model)
    {
        $model->title = $model->title . ".observer1";
    }

    public function created(Model $model)
    {
        $model->status = !$model->status;
        $model->saveQuietly();
    }

    public function updating(Model $model)
    {
        $model->content = $model->content . "@updating1";
    }

    public function updated(Model $model)
    {
        $model->status = !$model->status;
        $model->saveQuietly();
    }

    public function deleting(Model $model)
    {
        config()->set('app.name', 'Observer1');
    }

    public function deleted(Model $model)
    {
        $post = new \Workbench\App\Models\PostCustomOneObserver();
        $post->title = 'surprise';
        $post->content = 'this ovserver so cool';
        $post->status = true;
        $post->save();
    }
}
