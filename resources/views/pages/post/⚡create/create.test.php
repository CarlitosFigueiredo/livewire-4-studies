<?php

use App\Models\Post;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('renders successfully', function () {
    Livewire::test('pages::post.create')
        ->assertStatus(200);
});

test('create post succesfully', function () {

    assertDatabaseMissing(Post::class, [
        'title' => 'Test Title',
        'content' => 'Test Content',
    ]);

    Livewire::visit('pages::post.create')
        ->type('[wire\\:model="title"]', 'Test Title')
        ->type('[wire\\:model="content"]', 'Test Content')
        ->press('Save')
        ->assertPathIs('/');

    assertDatabaseHas(Post::class, [
        'title' => 'Test Title',
        'content' => 'Test Content',
    ]);
});
