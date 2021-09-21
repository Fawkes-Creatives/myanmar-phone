<?php
/**
 * @author fawkescreatives created on 20/09/2021
 */

namespace MyanmarPhone;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MyanmarPhone\Contracts\MyanmarPhone as MyanmarPhoneContract;

class MyanmarPhoneServiceProvider extends ServiceProvider
{
    /* @var Application */
    protected $app;

    public function register()
    {
        $this->app->bind(MyanmarPhoneContract::class, function ($app) {
            return $app->make(MyanmarPhone::class);
        });
    }
}