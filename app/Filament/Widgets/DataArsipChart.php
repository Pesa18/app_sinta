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

        // $query = Dataarsip::with('user')->get();
        // $userData = $query->groupBy('user_id')->map(function ($group) {
        //     return [
        //         'name' => $group->first()->user->name, // Nama user
        //         'count' => $group->count() // Jumlah arsip
        //     ];
        // })->values();

        // dd(array_values($userData->pluck('name')->all()));
        Carbon::setLocale('id');
        // $currentYear = Carbon::now()->year;
        // $userData = Dataarsip::whereYear('tanggal_arsip', $currentYear)
        //     ->get()
        //     ->groupBy(function ($date) {
        //         return Carbon::parse($date->tanggal_arsip)->translatedFormat('F'); // Format bulan dan tahun
        //     })
        //     ->map(function ($group) {
        //         return [
        //             'month' => Carbon::parse($group->first()->tanggal_arsip)->translatedFormat('F'), // Nama bulan dan tahun
        //             'count' => $group->count() // Jumlah arsip pada bulan tersebut
        //         ];
        //     });



        // $allMonths = [
        //     'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        //     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];

        // // Inisialisasi array untuk menyimpan hasil
        // $labels = [];
        // $data = [];

        // // Iterasi setiap bulan
        // foreach ($allMonths as $index => $month) {
        //     $monthKey = Carbon::createFromDate($currentYear, $index + 1, 1)->translatedFormat('F');
        //     // Jika bulan ada dalam data arsip, ambil jumlahnya, jika tidak, set ke 0
        //     if ($userData->has($monthKey)) {
        //         $labels[] = $userData[$monthKey]['month'];
        //         $data[] = $userData[$monthKey]['count'];
        //     } else {
        //         $labels[] = $month;
        //         $data[] = 0;
        //     }
        // }

        // dd($userData);



        $data = Trend::query(Dataarsip::where('arsip_pegawai_id', null))
            ->dateColumn('tanggal_arsip')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();


        // dd(now()->startOfYear());

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
