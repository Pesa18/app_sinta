<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DataarsipResource;
use App\Models\Dataarsip;
use Coduo\PHPHumanizer\NumberHumanizer;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class LokasiArsipMapping extends BaseWidget
{
    protected function getStats(): array
    {


        $query = Dataarsip::with('lokasi')->where('user_id', auth()->id())->get();
        $lokasiData = $query->groupBy('lokasi_id')->map(function ($group) {
            return [
                'nama_lokasi' => $group->first()->lokasi->nama_lokasi, // Nama user
                'count' => $group->count() // Jumlah arsip
            ];
        })->values();



        $arrayData = $lokasiData->take(5)->map(function ($data) {
            return Stat::make('Lokasi', NumberHumanizer::metricSuffix($data['count']))->description($data['nama_lokasi'])->color('primary')->descriptionIcon('heroicon-o-archive-box');
        });


        $data =  $arrayData->toArray();

        $data[] = Stat::make('', "Semua Arsip")->extraAttributes(['style' => 'background-color: #02558e!important;'])->description('Lihat')->descriptionIcon('heroicon-o-arrow-right')->color("white")->url(DataarsipResource::getUrl());

        return $data;
    }
    protected function getColumns(): int
    {

        return 3;
    }
}
