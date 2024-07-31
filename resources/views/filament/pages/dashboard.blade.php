<x-filament-panels::page>
    <div class="w-full">
        <div class=" flex flex-row mb-4 gap-4">
            <div class="w-full flex flex-col gap-4">
                @livewire('Filament\Widgets\AccountWidget')
                @livewire('App\Filament\Widgets\ChartArsipUser')
            </div>
            <div class="w-full flex flex-col gap-4">
                @livewire('App\Filament\Widgets\StatPerUser')
                @livewire('App\Filament\Widgets\LokasiArsipMapping')

            </div>
        </div>


        @can('akses-dashboard-admin')
            @livewire('App\Filament\Widgets\StatistikData')
            <div class="mt-6  flex flex-row gap-4">
                <div class="w-full">
                    @livewire('App\Filament\Widgets\DataArsipChart')
                </div>
                <div class="w-1/2">
                    @livewire('App\Filament\Widgets\arsipPerUser')
                </div>
            </div>
        @endcan


        {{-- {{ $this->data() }} --}}
    </div>
</x-filament-panels::page>
