<?php

use Workbench\App\Models\PostCustomMultiObserver;

beforeEach(function() {
    $this->postData = [
        'title' => 'Test Post',
        'content' => 'This is a test post content.',
        'status' => true,
    ];
});

it('triggers custom multi observer on post creation', function () {
    $post = PostCustomMultiObserver::create($this->postData);
    expect($post)
        ->toBeInstanceOf(PostCustomMultiObserver::class)
        ->title->toBe('Test Post.observer1.observer2')
        ->status->toBe(true);
});

it('triggers custom multi observer on post update', function () {
    $post = PostCustomMultiObserver::create($this->postData);
    
    expect($post)
        ->toBeInstanceOf(PostCustomMultiObserver::class)
        ->content->toBe('This is a test post content.');

    $post->update(['title' => 'Updated Test Post']);

    expect($post)
        ->content->toBe('This is a test post content.@updating1@updating2')
        ->status->toBe(true);
});

it('triggers custom multi observer on post deletion', function () {
    $post = PostCustomMultiObserver::create($this->postData);
    
    expect($post)
        ->toBeInstanceOf(PostCustomMultiObserver::class)
        ->title->toBe('Test Post.observer1.observer2')
        ->content->toBe('This is a test post content.')
        ->status->toBe(true);

    expect(config('app.name'))->toBe('Laravel');
    expect(config('app.timezone'))->toBe('UTC');

    $post->delete();
    expect(config('app.name'))->toBe('Observer2');
    expect(config('app.timezone'))->toBe('Asia/Baghdad');

    config()->set('app.name', 'Laravel');
    config()->set('app.timezone', 'UTC');
});
