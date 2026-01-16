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

        @island
            <x-pages::analytics.metric heading="Views" :number="$this->views" :change="12">

                <flux:button wire:click="$refresh" icon="arrow-path" variant="subtle" size="sm" />
            </x-pages::analytics.metric>
        @endisland

        <x-pages::analytics.metric heading="Visitors" :number="$this->visitors" :change="8">
            <!-- ... -->
        </x-pages::analytics.metric>

        <x-pages::analytics.metric heading="Avg time on post" :number="$this->avgTime" :change="-3">
            <!-- ... -->
        </x-pages::analytics.metric>
    </div>

    <div class="mt-8">
        <flux:heading size="lg">Top posts</flux:heading>
        <flux:text class="mt-1.5">The most viewed posts on your website</flux:text>

        <flux:table class="mt-4">
            <flux:table.columns>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column>Views</flux:table.column>
            </flux:table.columns>
        </flux:table>
    </div>
</div>



<flux:table :paginate="$this->orders">
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'date'" :direction="$sortDirection" wire:click="sort('date')">Date</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'amount'" :direction="$sortDirection" wire:click="sort('amount')">Amount</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($this->orders as $order)
            <flux:table.row :key="$order->id">
                <flux:table.cell class="flex items-center gap-3">
                    <flux:avatar size="xs" src="{{ $order->customer_avatar }}" />

                    {{ $order->customer }}
                </flux:table.cell>

                <flux:table.cell class="whitespace-nowrap">{{ $order->date }}</flux:table.cell>

                <flux:table.cell>
                    <flux:badge size="sm" :color="$order->status_color" inset="top bottom">{{ $order->status }}</flux:badge>
                </flux:table.cell>

                <flux:table.cell variant="strong">{{ $order->amount }}</flux:table.cell>

                <flux:table.cell>
                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                </flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
