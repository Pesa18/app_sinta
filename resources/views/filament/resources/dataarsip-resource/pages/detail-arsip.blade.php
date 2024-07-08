<x-filament-panels::page>
    <div class="lg:flex lg:flex-row sm:flex-col">
        <x-filament::section class=" w-full">
            <div>
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Informasi Arsip</h3>
                    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-400">No Arsip : {{ $record->noarsip }}</p>
                </div>
                <div class="mt-6 border-t border-gray-100">
                    <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Nama Arsip</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->nama_arsip }}
                            </dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">User Pencipta</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->user->name }}</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ Carbon\Carbon::parse($record->tanggal_arsip)->format('d M Y') }}
                            </dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Pencipta</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->pencipta->nama_pencipta }}</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Pengolah</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->pengolah->nama_pengolah }}</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Klasifikasi</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->kode->nama }}
                            </dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Lokasi</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->lokasi->nama_lokasi }}
                            </dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Media</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->media->nama_media }}
                            </dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Keterangan Keaslian</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->ket }}</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Pengolah</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                                {{ $record->uraian }}</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Jumlah Arsip</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">$120,000</dd>
                        </div>
                        <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Nomor Box</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">$120,000</dd>
                        </div>

                        <div class="px-4 py-4  sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">File</dt>
                            <dd class="mt-2  text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <ul role="list"
                                    class="divide-y divide-gray-100 px-4  rounded-md border border-gray-200">

                                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                        <div class="flex w-0 flex-1 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-6 h-5 w-5 flex-shrink-0 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                            </svg>
                                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                <span class="truncate font-medium">{{ $record->file_name }}</span>
                                                <span
                                                    class="flex-shrink-0 text-gray-400">{{ $record->file_size }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href={{ url($record->file_arsip) }} download={{ $record->file_name }}
                                                class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>



        </x-filament::section>
        <div class=" w-full">
            <iframe id="pdf-js-viewer" src={{ url($record->file_arsip) }} frameborder="0" scrolling="yes"
                style="display:block; width:100%; height:100%;"></iframe>

        </div>


    </div>
</x-filament-panels::page>
