<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DataArsipChart;
use App\Filament\Widgets\StatistikData;
use Filament\Pages\Page;
use Filament\Widgets;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-home';

    protected static string $view = 'filament.pages.dashboard';



    public function data()
    {
        return Widgets\AccountWidget::class;
    }
}
