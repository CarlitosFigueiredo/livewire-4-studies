<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public function mount()
    {
        usLeep(100* 1000); // 100ms
    }
};
?>

@placeholder
    <flux:skeleton class="min-h56 rounded-lg" animate="shimer" />
@endplaceholder

<div {{ $attributes->class('flex flex-col justify-between p-4 rounded-lg min-h-56') }}>

    <div>
        <flux:heading size="lg">{{ $post->title }}</flux:heading>
        <flux:text class="mt-1 text-xs text-zinc-500">{{ $post->created_at->format('M d, Y') }}</flux:text>
        <flux:text class="mt-4 line-clamp-3">{{ $post->content }}</flux:text>
    </div>

    <div class="mt-6 flex justify-between">
        <div class="flex items-center">

            @if ($post->status === 'published')
                <flux:badge rounded size="sm" variant="solid">Published</flux:badge>
            @else
                <flux:badge rounded size="sm" variant="solid">Draft</flux:badge>
            @endif

        </div>
    </div>
</div>
