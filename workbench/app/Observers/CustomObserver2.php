<?php

namespace Workbench\App\Observers;

use Illuminate\Database\Eloquent\Model;

class CustomObserver2
{
    public function creating(Model $model)
    {
        $model->title = $model->title . ".observer2";
    }

    public function created(Model $model)
    {
        $model->status = !$model->status;
        $model->saveQuietly();
    }

    public function updating(Model $model)
    {
        $model->content = $model->content . "@updating2";
    }

    public function updated(Model $model)
    {
        $model->status = !$model->status;
        $model->saveQuietly();
    }

    public function deleting(Model $model)
    {
        config()->set('app.name', 'Observer2');
    }

    public function deleted(Model $model)
    {
        config()->set('app.timezone', 'Asia/Baghdad');
    }
}
