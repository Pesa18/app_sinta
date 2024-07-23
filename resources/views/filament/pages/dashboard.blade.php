<x-filament-panels::page>
    <div>
        @livewire('App\Filament\Widgets\StatistikData')

        @can('akses-dashboard-admin')
            <div class="mt-6 ">
                @livewire('App\Filament\Widgets\DataArsipChart')


            </div>
        @endcan


        {{ $this->data() }}
    </div>
</x-filament-panels::page>
