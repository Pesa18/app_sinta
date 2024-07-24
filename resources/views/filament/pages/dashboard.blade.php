<x-filament-panels::page>
    <div class="w-full">
        @livewire('App\Filament\Widgets\StatistikData')

        @can('akses-dashboard-admin')
            <div class="mt-6  flex flex-row gap-4">
                @livewire('App\Filament\Widgets\DataArsipChart')

                <div>
                    @livewire('App\Filament\Widgets\arsipPerUser')
                </div>



            </div>
        @endcan


        {{ $this->data() }}
    </div>
</x-filament-panels::page>
