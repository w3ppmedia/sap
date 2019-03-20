<?php namespace App\Connectors\Sap\Di\Server;

class Runner
{
    protected $client;

    protected $request;

    public function process() {
        $this->client->sendRequest($this->request->saveXml());
    }
}