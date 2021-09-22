<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MyanmarPhone\Contracts\MyanmarPhone as MyanmarPhoneContract;
use MyanmarPhone\Validations\MyanmarPhoneValidation;

class MyanmarPhoneServiceProvider extends ServiceProvider
{
    /* @var Application */
    protected $app;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/myanmar_phone.php' => $this->app->configPath('myanmar_phone.php'),
            ]);
        }

        $this->app['validator']->extendDependent('myanmar_phone', MyanmarPhoneValidation::class . '@validate');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/myanmar_phone.php', 'myanmar_phone');

        $this->app->bind(MyanmarPhoneContract::class, function ($app) {
            return $app->make(MyanmarPhone::class);
        });
    }
}