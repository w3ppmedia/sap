<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Config;
use App\Connectors\SapConnector;

class ConnectorConfigServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request)
    {
        if ($request->hasHeader('database')) {
            config(['sap.database' => $request->header('database')]);
        }

        if ($request->hasHeader('username')) {
            config(['sap.username' => $request->header('username')]);
        }

        if ($request->hasHeader('password')) {
            config(['sap.password' => $request->header('password')]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SapConnector::class, function ($app) {
            return new SapConnector(config('sap'));
        });
    }
}