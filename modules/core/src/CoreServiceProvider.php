<?php

namespace Modules\Core;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Facades\Menu\MenuFacade;
use Modules\Core\Facades\Ticket\TicketFacade;
use Modules\Core\Repositories\Menu\MenuRepository;
use Modules\Core\Repositories\Ticket\TicketRepository;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        MenuFacade::shouldProxyTo(MenuRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/views','user');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/core.php', 'core');
        $this->loadViewComponentsAs('', [
            // import blade components here
        ]);
    }
}
