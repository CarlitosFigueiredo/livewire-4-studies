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
?>

<form wire:submit="save" class="w-96 space-y-6">

    <flux:input wire:model="title" label="Title" />

    <flux:textarea wire:model="content" label="Content" />

    <flux:button type="submit" variant="primary">Save</flux:button>
</form>
