<?php

namespace App\Filament\Widgets;

use App\Models\Dataarsip;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Coduo\PHPHumanizer\NumberHumanizer;


class StatistikData extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Arsip', NumberHumanizer::metricSuffix(Dataarsip::where('arsip_pegawai_id', null)->count()))->description('32k increase')->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
