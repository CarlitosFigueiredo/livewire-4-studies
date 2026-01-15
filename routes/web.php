<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/posts', 'pages::post.posts');
Route::livewire('post/create', 'pages::post.create');
