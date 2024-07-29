<?php

namespace App\Filament\Widgets;

use App\Models\Dataarsip;
use Closure;
use Flowframe\Trend\Trend;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Coduo\PHPHumanizer\NumberHumanizer;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;


class StatistikData extends BaseWidget
{
    protected function getStats(): array
    {

        $data = Trend::model(Dataarsip::class)
            ->dateColumn('tanggal_arsip')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();


        $array_data = $data->map(fn (TrendValue $value) => $value->aggregate)->toArray();


        $increase = $array_data[Carbon::parse(now())->format("m") - 1] - $array_data[Carbon::parse(now())->format("m") - 2];


        return [
            Stat::make('Jumlah Arsip', NumberHumanizer::metricSuffix(Dataarsip::where('arsip_pegawai_id', null)->count()))->description($increase . "Meningkat")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($data->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('success'),
            Stat::make('Jumlah Arsip Pegawai', NumberHumanizer::metricSuffix(Dataarsip::whereNotNull('arsip_pegawai_id')->count())),
            Stat::make('Jumlah User', User::count()),
        ];
    }
}
