<?php

namespace App\Filament\Widgets;

use App\Models\Dataarsip;
use Filament\Widgets\ChartWidget;

class arsipPerUser extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array

    {
        $query = Dataarsip::with('user')->get();
        $userData = $query->groupBy('user_id')->map(function ($group) {
            return [
                'name' => $group->first()->user->name, // Nama user
                'count' => $group->count() // Jumlah arsip
            ];
        })->values();

        // dd(array_values($userData->pluck('name')->all()));
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Arsip',
                    'data' => array_values($userData->pluck('count')->values()->all()),
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
            'labels' => array_values($userData->pluck('name')->values()->all()),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
