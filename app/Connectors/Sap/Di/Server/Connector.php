<?php namespace App\Connectors\Sap\Di\Server;

class Connector extends Builder
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Connector constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param $sessionId
     */
    public function setClientSession($sessionId) {
        $this->client->setSessionId($sessionId);
    }

    /**
     * @param $credentials
     */
    public function createClientSession($credentials) {
        $this->client->login($credentials);
    }

    /**
     * @param $sessionId
     */
    public function destroyClientSession($sessionId) {
        $this->client->logout($sessionId);
    }

    /**
     * @return mixed
     */
    public function getClientSession() {
        return $this->client->getSession();
    }
 }