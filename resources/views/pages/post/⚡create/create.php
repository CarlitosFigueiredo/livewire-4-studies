<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

new #[Layout('layouts::app', ['title' => 'Create post'])] class extends Component
{
    public string $title = '';
    public string $content = '';

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($validated);

        $this->redirect('/');
    }
};
