<?php

use Waad\Observer\Attributes\HasObservers;
use Workbench\App\Models\PostAttributeObserver;
use Workbench\Observers\PostObserver;

beforeEach(function () {
    $this->postData = [
        'title' => 'Test Post',
        'content' => 'This is a test post content.',
        'status' => true,
    ];
});

it('registers observer via HasObservers attribute', function () {
    $reflection = new ReflectionClass(PostAttributeObserver::class);
    $attributes = $reflection->getAttributes(HasObservers::class);

    expect($attributes)->toHaveCount(1);
    expect($attributes[0]->newInstance()->observer)->toBe(PostObserver::class);
});

it('triggers observer on post creation with attribute', function () {
    $post = PostAttributeObserver::create($this->postData);
    expect($post)->toBeInstanceOf(PostAttributeObserver::class);
    expect($post->title)->toBe('Test Post.observer');
    expect($post->status)->toBe(false);
});

it('triggers observer on post update with attribute', function () {
    $post = PostAttributeObserver::create($this->postData);
    expect($post)->toBeInstanceOf(PostAttributeObserver::class);
    expect($post->content)->toBe('This is a test post content.');

    $post->update([
        'title' => 'Updated Test Post',
    ]);

    expect($post->content)->toBe('This is a test post content.@updating');
    expect($post->status)->toBe(true);
});

it('triggers observer on post deletion with attribute', function () {
    $post = PostAttributeObserver::create($this->postData);
    expect($post)->toBeInstanceOf(PostAttributeObserver::class);
    expect($post->title)->toBe('Test Post.observer');
    expect($post->content)->toBe('This is a test post content.');
    expect($post->status)->toBe(false);

    expect(config('app.name'))->toBe('Laravel');
    $post->delete();
    expect(config('app.name'))->toBe('Observer');
    config()->set('app.name', 'Laravel');

    $postAfterDelete = PostAttributeObserver::latest()->first();
    expect($postAfterDelete->title)->toBe('surprise.observer');
    expect($postAfterDelete->content)->toBe('this ovserver so cool');
    expect($postAfterDelete->status)->toBe(false);
});
