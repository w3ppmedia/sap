<?php namespace App\Connectors\Sap\Di\Server;

class Runner
{
    protected $client;

    protected $request;

    public function process() {
    	$xml = $this->request->saveXml();

    	try {
    		$this->client->sendRequest($xml);
    	} catch (\Exception  $e) {
    		throw $e;
    	}
    }
}