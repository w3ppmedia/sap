<?php namespace App\Connectors\Sap\Di\Server;

class Client implements ClientInterface
{
    use Authentication;

    private $obj;

    private $response;

    public function __construct()
    {
        $this->obj = new \COM('SBODI_Server.node') or die ('No connection');
    }

    public function send($xml) {
        $response = $this->obj->Interact($xml);
        $this->setResponse($response);
    }

    public function setResponse($xml) {
        $this->response = new ResponseSapXMLParser('1.0', 'UTF-8');
        $this->response->loadXML($xml);
    }

    /**
     * @return ResponseSapXMLParser
     */
    public function getResponse() : ResponseSapXMLParser {
        return $this->response;
    }
}