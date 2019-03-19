<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use App\Connectors\Sap\Di\Server\Client;
use App\Connectors\Sap\Di\Server\Connector;

class ConnectorConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {}

    /**
     * Register any application services.
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client();
        });

        $this->app->singleton(Connector::class, function ($app) use ($request) {
            $connector = new Connector($app->make(Client::class));

            if ($request->hasHeader('session')) {
                $connector->setClientSession($request->header('session'));
            }

            return $connector;
        });
    }
}