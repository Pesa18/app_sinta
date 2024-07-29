<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Dataarsip;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon as IluminateCarbon;

class DataArsipChart extends ChartWidget
{
    protected static ?string $heading = 'Data Statistik';

    protected function getData(): array
    {
        Carbon::setLocale('id');
        $data = Trend::query(Dataarsip::where('arsip_pegawai_id', null))
            ->dateColumn('tanggal_arsip')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Arsip',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',    // Light Red
                        'rgb(54, 162, 235)',    // Light Blue
                        'rgb(75, 192, 192)',    // Light Teal
                        'rgb(255, 206, 86)',    // Light Yellow
                        'rgb(153, 102, 255)',   // Light Purple
                        'rgb(255, 159, 64)',    // Light Orange
                        'rgb(100, 181, 246)',   // Sky Blue
                        'rgb(255, 87, 34)',     // Deep Orange
                        'rgb(0, 150, 136)',     // Teal
                        'rgb(205, 220, 57)',    // Lime
                        'rgb(121, 85, 72)',     // Brown
                        'rgb(233, 30, 99)',     // Pink
                    ],
                    'hoverOffset' => 4
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('F')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
