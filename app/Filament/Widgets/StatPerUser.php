<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatPerUser extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Unique views', '192.1k')->extraAttributes([
                'class' => 'col-span-2 w-full',
            ]),
            Stat::make('Unique views', '192.1k')->extraAttributes([
                'class' => 'col-span-1 w-full',
            ]),
            Stat::make('Unique views', '192.1k')->extraAttributes([
                'class' => 'col-span-1 w-full',
            ]),
        ];
    }
}
