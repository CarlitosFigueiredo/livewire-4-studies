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
        Post::create($this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ]));

        $this->redirect('/');
    }
};
?>

<form wire:submit="save" class="w-96 space-y-6">
    <label class="block space-y-2">
        <p
            class="inline-flex items-center text-sm font-medium [:.where(&)]:text-zinc-800 [::where(&)]:dark:text-white [&:has([aria-invalid='true'])]:text-red-500">
            Title
        </p>
        <input type="text"
            class="w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-" />
    </label>

    <label class="block space-y-2">
        <p
            class="inline-flex items-center text-sm font-medium [:.where(&)]:text-zinc-800 [::where(&)]:dark:text-white [&:has([aria-invalid='true'])]:text-red-500">
            Content
        </p>
        <textarea
            class="block p-3 w-full shadow-xs disabled:shadow-none border rounded-lg bg-white dark:bg-dark"></textarea>
    </label>

    <button type="submit"
        class="relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-7">
        Save
    </button>
</form>


