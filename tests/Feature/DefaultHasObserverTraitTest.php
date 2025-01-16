<?php

use Workbench\App\Models\Post;

beforeEach(function() {
    $this->postData = [
        'title' => 'Test Post',
        'content' => 'This is a test post content.',
        'status' => true,
    ];
});

it('triggers observer on post creation', function () {
    $post = Post::create($this->postData);
    expect($post)->toBeInstanceOf(Post::class);
    expect($post->title)->toBe('Test Post.observer');
    expect($post->status)->toBe(false);
});

it('triggers observer on post update', function () {
    $post = Post::create($this->postData);
    expect($post)->toBeInstanceOf(Post::class);
    expect($post->content)->toBe('This is a test post content.');

    $post->update([
        'title' => 'Updated Test Post',
    ]);

    expect($post->content)->toBe('This is a test post content.@updating');
    expect($post->status)->toBe(true);
});

it('triggers observer on post deletion', function () {
    $post = Post::create($this->postData);
    expect($post)->toBeInstanceOf(Post::class);
    expect($post->title)->toBe('Test Post.observer');
    expect($post->content)->toBe('This is a test post content.');
    expect($post->status)->toBe(false);

    expect(config('app.name'))->toBe('Laravel');
    $post->delete();
    expect(config('app.name'))->toBe('Observer');
    config()->set('app.name', 'Laravel');

    $postAfterDelete = Post::latest()->first();
    expect($postAfterDelete->title)->toBe('surprise.observer');
    expect($postAfterDelete->content)->toBe('this ovserver so cool');
    expect($postAfterDelete->status)->toBe(false);
});

