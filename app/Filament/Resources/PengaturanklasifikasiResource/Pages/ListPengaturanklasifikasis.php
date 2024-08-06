<?php

namespace App\Filament\Resources\PengaturanklasifikasiResource\Pages;

use Filament\Actions;
use App\Models\Masterklasifikasi;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\PengaturanklasifikasiResource;

class ListPengaturanklasifikasis extends ListRecords
{
    protected static string $resource = PengaturanklasifikasiResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("Buat Klasifikasi")->form([
                Repeater::make('nama_klasifikasi')
                    ->schema([
                        TextInput::make('nama')->label('Nama Klasifkasi')->required(),
                        TextInput::make('kode')->label('Kode')->required(),
                        ToggleButtons::make('retensi')
                            ->label('Retensi Arsip')
                            ->options([
                                1 => 'Aktif',
                                0 => 'Tidak Aktif',

                            ])
                            ->colors([
                                0 => 'danger',
                                1 => 'success',
                            ])
                            ->icons([
                                0 => 'heroicon-o-x-circle',
                                1 => 'heroicon-o-check-circle'
                            ])
                            ->grouped()->default(1)

                    ])->columns(2)->addActionLabel('Tambah Lokasi')
            ])->action(function (array $data): void {

                Masterklasifikasi::insert($data['nama_klasifikasi']);
            })
        ];
    }
}
