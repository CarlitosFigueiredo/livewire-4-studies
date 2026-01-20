<div class="max-w-5xl [&:has([data-dim-selecting])[data-loading]>::not(:first-child)]:opacity-75 transition-opacity">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Analytics</flux:heading>
            <flux:text class="mt-2">Track your website traffic and performance</flux:text>
        </div>
    </div>

    <div>
        <flux:select wire:model.live="period" size="sm" data-dim-selecting>
            <flux:select.option value="today">Today</flux:select.option>
            <flux:select.option value="week">Last 7 days</flux:select.option>
            <flux:select.option value="month">Last 30 days</flux:select.option>
            <flux:select.option value="year">Last year</flux:select.option>
        </flux:select>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6 relative">

        @island(name: "metrics", lazy: true, always: true)

            @placeholder

                <flux:skeleton class="h-30" animate="shimer" />
                <flux:skeleton class="h-30" animate="shimer" />
                <flux:skeleton class="h-30" animate="shimer" />
            @endplacedolder

            <x-pages::analytics.metric heading="Views" :number="$this->views" :change="12" />
            <x-pages::analytics.metric heading="Visitors" :number="$this->visitors" :change="8" />
            <x-pages::analytics.metric heading="Avg time on post" :number="$this->avgTime" :change="-3" />
        @endisland

        <div class="absolute top-0 bottom-0 left-[100%] pl-4 flex">

            <flux:button wire:click="$refresh" wire:island="metrics" icon="arrow-path" variant="subtle" size="sm" />
        </div>
    </div>

    <flux:card class="mt-8">
        <flux:heading size="lg">Top posts</flux:heading>
        <flux:text class="mt-1.5">The most viewed posts on your website</flux:text>

        <flux:table class="mt-4">
            <flux:table.columns>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column>Views</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>

                @island('posts', always: true)

                    @foreach ($this->topPosts as $post)
                        <flux:table.row>
                            <flux:table.cell>{{ $post->title }}</flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap">{{ $post->created_at->format('M j, Y') }}
                            </flux:table.cell>
                            <flux:table.cell>{{ number_format($post->page_views_count) }}</flux:table.cell>
                        </flux:table.row>
                    @endforeach
                @endisland
            </flux:table.rows>
        </flux:table>

        <flux:button wire:click="loadMorePosts" wire:island.append="posts" class="mt-4 w-full" size="sm" variant="subtle" icon="chevron-down">Load more</flux:button>
    </flux:card>

    <flux:card class="col-span-2">
        <flux:heading size="lg">Top countries</flux:heading>
        <flux:text class="mt-1.5">The top countries of traffic to your website</flux:text>

        @php $countries = $this->topCountries; @endphp

        <div class="mt-6 space-y-3 grid grid-cols-[auto_1fr_auto]">
            @foreach ($countries as $country)
                <div class="grid col-span-3 grid-cols-subgrid items-center gap-x-6">
                    <flux:heading class="capitalize">{{ $country->country }}</flux:heading>
                        <div class="w-full bg-zinc-200 dark:bg-white/20 rounded-full h-1">
                            <div class="bg-zinc-800 dark:bg-black h-1 rounded-full"
                                style="width: {{ ($country->total / $countries->first()->total) * 100 }}%"></div>
                        </div>
                    <flux:text>{{ number_format($country->total) }}</flux:text>
                </div>
            @endforeach
        </div>
    </flux:card>

    <flux:card class="col-span-1">

        <flux:heading size="lg">Traffic sources</flux:heading>
        <flux:text class="mt-1.5">The sources of traffic to your website</flux:text>

        <div class="mt-6 space-y-3">
            @foreach ($this->trafficSources as $source)
                <div class="flex items-center justify-between">
                    <flux:heading class="capitalize">{{ $source->source }}</flux:heading>
                    <flux:text>{{ number_format($source->total) }}</flux:text>
                </div>
            @endforeach
        </div>
    </flux:card>
</div>
