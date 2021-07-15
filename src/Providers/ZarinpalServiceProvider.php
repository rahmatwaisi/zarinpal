<?php

namespace RahmatWaisi\Zarinpal\Providers;

use Illuminate\Support\ServiceProvider;
use RahmatWaisi\Zarinpal\ZarinpalService;

class ZarinpalServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('zarinpal', function () {
            return new ZarinpalService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = __DIR__ . '/../config/zarinpal.php';



        $this->publishes([
            $config => config_path('zarinpal.php'),
        ], 'zarinpal-config');
    }
}
