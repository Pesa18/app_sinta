<x-filament-panels::page>
    <div class="w-full">

        <div class=" flex flex-row mb-4 gap-2">
            <div class="w-full  ">
                @livewire('Filament\Widgets\AccountWidget')
            </div>
            <div class="w-full ">
                @livewire('App\Filament\Widgets\StatPerUser')
            </div>

        </div>


        @livewire('App\Filament\Widgets\StatistikData')


        @can('akses-dashboard-admin')
            <div class="mt-6  flex flex-row gap-4">

                <div class="w-full">
                    @livewire('App\Filament\Widgets\DataArsipChart')
                </div>


                <div class="w-1/2">
                    @livewire('App\Filament\Widgets\arsipPerUser')
                </div>



            </div>
        @endcan


        {{ $this->data() }}
    </div>
</x-filament-panels::page>
