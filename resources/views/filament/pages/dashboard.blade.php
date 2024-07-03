<x-filament-panels::page>
    <div>
        @livewire('App\Filament\Widgets\StatistikData')
        <div class="mt-6 flex flex-row gap-4">
            @livewire('App\Filament\Widgets\DataArsipChart')

            @livewire('App\Filament\Widgets\DataArsipChart')

        </div>

        {{ $this->data() }}
    </div>
</x-filament-panels::page>
