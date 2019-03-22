<?php namespace App\Connectors\Sap\Di\Server;

abstract class Runner
{
    protected $client;

    protected $request;

    public function process() {
    	$xml = $this->request->saveXml();

    	try {
    		$this->client->sendRequest($xml);
    		$this->setLastKey($this->client->getResponse()->getValueByQuery('xmlns:AddObjectResponse/xmlns:RetKey'));
    	} catch (\Exception  $e) {
    		throw $e;
    	}
    }

    /**
     * @param mixed $lastKey
     */
    protected abstract function setLastKey($lastKey): void;
}