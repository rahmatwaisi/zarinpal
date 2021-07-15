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

        $callbackController = __DIR__ . '/../Http/Controllers/PaymentCallbackController.php';

        $this->publishes([
            $callbackController => app_path('Http/Controllers/Zarinpal/PaymentCallbackController.php'),
        ],'zarinpal-controller');

        $this->publishes([
            $config => config_path('zarinpal.php'),
        ], 'zarinpal-config');
    }
}
