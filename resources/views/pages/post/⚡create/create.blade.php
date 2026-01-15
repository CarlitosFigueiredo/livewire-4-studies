<form wire:submit="save" class="w-96 space-y-6">

    <flux:input wire:model="title" label="Title" />

    <flux:textarea wire:model="content" label="Content" />

    <flux:button type="submit" variant="primary">Save</flux:button>
</form>