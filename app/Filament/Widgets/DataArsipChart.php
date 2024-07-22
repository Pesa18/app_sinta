<?php

namespace App\Filament\Widgets;

use App\Models\Dataarsip;
use Filament\Widgets\ChartWidget;

class DataArsipChart extends ChartWidget
{
    protected static ?string $heading = 'Data Statistik';

    protected function getData(): array
    {

        $query = Dataarsip::with('user')->get();
        $userData = $query->groupBy('user_id')->map(function ($group) {
            return [
                'name' => $group->first()->user->name, // Nama user
                'count' => $group->count() // Jumlah arsip
            ];
        })->values()->all();



        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $userData
                ],
            ],
            'labels' => $userData,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
