<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Post;

new #[Title('Posts')] class extends Component
{
    public string $sort = 'newest';
    public array $selected = [];

    #[Computed]
    public function posts()
    {
        return Post::query()
            ->tap(fn ($q) => match ($this->sort) {
                'oldest' => $q->orderBy('created_at', 'asc'),
                'popular' => $q->orderBy('views', 'desc'),
                default => $q->latest(),
            })
            ->get();
    }

    public function deleteSelected()
    {
        Post::whereIn('id', $this->selected)->delete();

        $this->selected = [];
    }
};
