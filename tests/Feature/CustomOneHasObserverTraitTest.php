<?php

use Workbench\App\Models\PostCustomOneObserver;

beforeEach(function() {
    $this->postData = [
        'title' => 'Test Post',
        'content' => 'This is a test post content.',
        'status' => true,
    ];
});

it('triggers custom one observer on post creation', function () {
    $post = PostCustomOneObserver::create($this->postData);
    
    expect($post)
        ->toBeInstanceOf(PostCustomOneObserver::class)
        ->title->toBe('Test Post.observer1')
        ->status->toBe(false);
});

it('triggers custom one observer on post update', function () {
    $post = PostCustomOneObserver::create($this->postData);
    
    expect($post)
        ->toBeInstanceOf(PostCustomOneObserver::class)
        ->content->toBe('This is a test post content.');

    $post->update(['title' => 'Updated Test Post']);

    expect($post)
        ->content->toBe('This is a test post content.@updating1')
        ->status->toBe(true);
});

it('triggers custom one observer on post deletion', function () {
    $post = PostCustomOneObserver::create($this->postData);
    
    expect($post)
        ->toBeInstanceOf(PostCustomOneObserver::class)
        ->title->toBe('Test Post.observer1')
        ->content->toBe('This is a test post content.')
        ->status->toBe(false);

    expect(config('app.name'))->toBe('Laravel');
    $post->delete();
    expect(config('app.name'))->toBe('Observer1');
    config()->set('app.name', 'Laravel');

    $postAfterDelete = PostCustomOneObserver::latest()->first();
    expect($postAfterDelete)
        ->title->toBe('surprise.observer1')
        ->content->toBe('this ovserver so cool')
        ->status->toBe(false);
});
