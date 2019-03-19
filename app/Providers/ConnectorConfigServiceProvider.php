<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use App\Connectors\Sap\Di\Server\Client;
use App\Connectors\Sap\Di\Server\Connector;

class ConnectorConfigServiceProvider extends ServiceProvider
{
    private $session;
    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request) {
        if ($request->hasHeader('session')) {
            $this->session = $request->header('session');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client();
        });

        $this->app->singleton(Connector::class, function ($app) {
            $connector = new Connector($app->make(Client::class));

            if (isset($this->session)) {
                $connector->setClientSession($this->session);
            }

            return $connector;
        });
    }
}