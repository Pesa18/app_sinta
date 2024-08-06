<x-filament::breadcrumbs :breadcrumbs="[
    'arsip-pegawai' => 'Arsip Pegawai',
    '' => 'Daftar',
]" />

<div class="font-bold text-3xl">Arsip Pegawai</div>
@can('akses-import-data')
    <div class="container flex flex-row gap-2">
        <form wire:submit="saveImport" class="flex flex-row gap-2">
            <x-filament::input.wrapper :valid="!$errors->has('file')">
                <x-filament::input type="file" wire:model="file" accept=".csv,.xls" />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="info" icon="heroicon-m-arrow-up-on-square">
                <div class="flex flex-row">
                    <x-filament::loading-indicator wire:loading wire:target="saveImport" class="h-5 w-5" /> Import
                </div>

            </x-filament::button>
        </form>
        <x-filament::button type="button" download="data-import.csv" href="/ImportPegawai.csv" tag="a"
            icon="heroicon-m-arrow-down-on-square">
            Download Template
        </x-filament::button>
    </div>
@endcan
@error('file')
    <span class="text-sm" style="color: red">{{ $message }}</span>
@enderror
