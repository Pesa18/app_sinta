<x-filament::breadcrumbs :breadcrumbs="[
    'data-arsip' => 'Data Arsip',
    '' => 'Daftar',
]" />

<div class="font-bold text-3xl">Data Arsip</div>

@can('akses-import-data')
    <div class="container flex flex-row gap-2">
        <form wire:submit="saveImport" class="flex flex-row gap-2">
            <x-filament::input.wrapper :valid="!$errors->has('file')">
                <x-filament::input type="file" wire:model="file" accept=".csv,.xls,.xlsx" />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="info" icon="heroicon-m-arrow-up-on-square">
                <div class="flex flex-row">
                    <x-filament::loading-indicator wire:loading wire:target="saveImport" class="h-5 w-5" /> Import
                </div>

            </x-filament::button>
        </form>
        <x-filament::button type="button" download="data-import.csv" href="/importExcel.csv" tag="a"
            icon="heroicon-m-arrow-down-on-square">
            Download Template
        </x-filament::button>
    </div>
@endcan

@error('file')
    <span class="text-sm" style="color: red">{{ $message }}</span>
@enderror
