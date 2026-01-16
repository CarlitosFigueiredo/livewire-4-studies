<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Lazy;

new #[Title('Posts')] class extends Component
{
    public string $sort = 'newest';

    #[Computed]
    public function posts()
    {
        return Post::query()
            ->tap(fn ($q) => match ($this->sort) {
                'oldest' => $q->orderBy('created_at', 'asc'),
                'popular' => $q->orderBy('views', 'desc'),
                default => $q->latest(),
            })
            ->paginate(20);
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
};
