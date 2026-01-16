<div class="max-w-5xl">
    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">Posts</flux:heading>
            <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
        </div>

        <div class="flex gap-2">
            <div class="max-lg:hidden flex justify-start items-center gap-2">
                <flux:subheading class="whitespace-nowrap">Sort by:</flux:subheading>

                <flux:select size="sm" wire:model.live="sort" data-dim-sorting>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Most popular</option>
                </flux:select>
            </div>

            <flux:separator vertical class="max-lg:hidden mx-2 my-2" />

            <flux:button variant="primary" icon="plus" size="sm" href="/post/create">New post</flux:button>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6 [*:has([data-dim-sorting][data-loading])_&]:opacity-50">
        @foreach ($this->posts as $post)

            <livewire:pages::post.card :$post
                :wire:key="$post->id"
                :lazy.bundle="$loop->iteration > 6"
                :class="$post->views > 500 ? 'border' : '' "
            />
        @endforeach
    </div>
</div>
