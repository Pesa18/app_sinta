<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ArsippegawaiResource;
use App\Filament\Resources\DataarsipResource;
use App\Filament\Resources\ImportdataResource;
use App\Filament\Resources\PengaturanklasifikasiResource;
use App\Filament\Resources\PengaturanlokasiResource;
use App\Filament\Resources\PengaturanmediaResource;
use App\Filament\Resources\PengaturanpenciptaResource;
use App\Filament\Resources\PengaturanpenggunaResource;
use App\Filament\Resources\PengaturanpengolahResource;
use App\Filament\Resources\SirkulasiarsipResource;
use App\Models\Dataarsip;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->sidebarCollapsibleOnDesktop()
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make()
                        ->items(
                            [NavigationItem::make('Beranda')->icon('heroicon-s-home')]
                        ),
                    NavigationGroup::make('Arsip')
                        ->items([
                            ...DataarsipResource::getNavigationItems(),
                            ...ArsippegawaiResource::getNavigationItems(),
                            ...SirkulasiarsipResource::getNavigationItems()
                        ])->icon('heroicon-s-archive-box'),
                    NavigationGroup::make('Pengaturan')
                        ->items([
                            ...PengaturanlokasiResource::getNavigationItems(),
                            ...PengaturanmediaResource::getNavigationItems(),
                            ...PengaturanpenciptaResource::getNavigationItems(),
                            ...PengaturanpenggunaResource::getNavigationItems(),
                            ...PengaturanpengolahResource::getNavigationItems(),
                            ...PengaturanklasifikasiResource::getNavigationItems(),
                        ])->icon('heroicon-s-cog-8-tooth'),
                    NavigationGroup::make()->items([
                        ...ImportdataResource::getNavigationItems()
                    ])
                ]);
            })

            ->colors([
                'primary' => Color::Purple,
            ])
            ->brandLogo(fn () => view('vendor.filament.components.brand'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
