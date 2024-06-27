<x-filament-panels::page>

    <x-filament::section>
        <div>{{ $record->noarsip }}</div>

        <iframe id="pdf-js-viewer" src={{ url($record->file_arsip) }}></iframe>
    </x-filament::section>





</x-filament-panels::page>
