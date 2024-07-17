<x-filament::breadcrumbs :breadcrumbs="[
    '/' => 'Data Arsip',
    '/data-arsip' => 'Daftar',
]" />

<div class="font-bold text-3xl">Data Arsip</div>
<div class="container">
    <form wire:submit="saveImport" class="flex flex-row gap-2">
        <x-filament::input.wrapper>
            <x-filament::input type="file" wire:model="file" />
        </x-filament::input.wrapper>
        <x-filament::button type="submit" icon="heroicon-m-sparkles">
            <div class="flex flex-row">
                <x-filament::loading-indicator wire:loading wire:target="saveImport" class="h-5 w-5" /> Import
            </div>

        </x-filament::button>
    </form>
    @if (session()->has('success'))
        <div class="mt-2 text-green-600">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="text-red-600 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
