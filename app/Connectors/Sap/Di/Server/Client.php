<?php namespace App\Connectors\Sap\Di\Server;

class Client
{
    use Authentication;

    private $obj;

    public function __construct()
    {
        $this->obj = new \COM('SBODI_Server.company') or die ('No connection');
    }

    public function send($xml) {
        $response = $this->obj->Interact();
        return simplexml_load_string($response);
    }
}