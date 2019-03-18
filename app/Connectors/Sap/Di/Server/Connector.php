<?php namespace App\Connectors\Sap\Di\Server;

use App\Connectors\Sap\Di\Server\Authentication;

class Connector
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function login() {
        $this->client->connect();
    }
 }