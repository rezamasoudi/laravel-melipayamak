<?php

namespace Masoudi\Melipayamak;

use Illuminate\Support\ServiceProvider;
use SoapClient;

class MeliPayamakServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MeliPayamak::class, function ($app) {
            $client = new SoapClient(config('melipayamak.uri'), ['encoding' => 'UTF-8']);
            $melipayamak = (new MeliPayamak($client))->setUser(config('melipayamak.user'), config('melipayamak.password'));

            return $melipayamak;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/melipayamak.php' => config_path('melipayamak.php'),
        ], 'melipayamak');
    }
}
