<?php namespace App\Connectors\Sap\Di\Server;

use App\Connectors\Sap\Di\Server\Authentication;

class Connector
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function login($credentials) {
        $this->client->login($credentials);
        return $this->client->getSession();
    }

    public function logout($sessionId) {
        $this->client->logout($sessionId);
        return true;
    }
 }