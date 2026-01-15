<?php

use App\Models\Post;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('example', function () {

    assertDatabaseMissing(Post::class, [
        'title' => 'Test Title',
        'content' => 'Test Content',
    ]);

    Livewire::test('pages::post.create')
        ->set('title', 'Test Title')
        ->set('content', 'Test Content')
        ->call('save')
        ->assertRedirect('/');

    assertDatabaseHas(Post::class, [
        'title' => 'Test Title',
        'content' => 'Test Content',
    ]);
});
