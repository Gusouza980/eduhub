<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;
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
            ->colors([
                'primary' => [
                    50 => '#f5f0fc',
                    100 => '#ede4f9',
                    200 => '#DBCDED', // thistle - background suave
                    300 => '#c2a6e8',
                    400 => '#a57dd6',
                    500 => '#7A48B9', // royal-purple - cor primária principal
                    600 => '#6838a0',
                    700 => '#541E87', // tekhelet - primária escura
                    800 => '#441871',
                    900 => '#371459',
                    950 => '#1B1028', // cor do texto principal
                ],
                'secondary' => [
                    50 => '#faf5fb',
                    100 => '#f4eaf7',
                    200 => '#e9d5ee',
                    300 => '#d9b4e0',
                    400 => '#c389cc',
                    500 => '#753279', // eminence - cor secundária principal
                    600 => '#8f4e94',
                    700 => '#6b2870',
                    800 => '#59245d',
                    900 => '#4a204c',
                    950 => '#2d0f2e',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->topbar(false)
            ->sidebarCollapsibleOnDesktop()
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight(function() {
                if(Route::has('filament.admin.auth.login') && Route::currentRouteName() === 'filament.admin.auth.login') {
                    return '6rem';
                }
                return '4rem';
            })
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
    }
}
