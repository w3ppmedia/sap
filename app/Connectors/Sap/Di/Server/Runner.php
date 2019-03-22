<?php namespace App\Connectors\Sap\Di\Server;

abstract class Runner
{
    protected $client;

    protected $request;

    protected $lastKey;

    public function process($actionType = 'AddObject') {
    	$xml = $this->request->saveXml();

    	try {
    		$this->client->sendRequest($xml);
    		$this->setLastKey($this->client->getResponse()->getValueByQuery('xmlns:'.$actionType.'Response/xmlns:RetKey'));
    	} catch (\Exception  $e) {
    		throw $e;
    	}
    }

    /**
     * @return mixed
     */
    protected function getLastKey()
    {
        return $this->lastKey;
    }

    /**
     * @param mixed $lastKey
     */
    protected function setLastKey($lastKey): void
    {
        $this->lastKey = $lastKey;
    }
}