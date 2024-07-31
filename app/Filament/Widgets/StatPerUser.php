<?php

namespace App\Filament\Widgets;

use App\Models\Dataarsip;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Coduo\PHPHumanizer\NumberHumanizer;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatPerUser extends BaseWidget
{
    protected function getStats(): array
    {
        $data = Trend::query(Dataarsip::where('arsip_pegawai_id', null)->where('user_id', auth()->id()))
            ->dateColumn('tanggal_arsip')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        return [
            Stat::make('Arsip User', NumberHumanizer::metricSuffix(Dataarsip::where('arsip_pegawai_id', null)->where('user_id', auth()->id())->count()))->extraAttributes([
                'class' => 'col-span-full',
            ])->chart($data->map(fn (TrendValue $value) => $value->aggregate)->toArray())->color('success')->descriptionColor('success')->description('Jumlah Arsip Berdasarkan User'),
        ];
    }

    protected function getColumns(): int
    {

        return 2;
    }
}
