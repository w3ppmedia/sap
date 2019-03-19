<?php namespace App\Connectors\Sap\Di\Server;

class Client implements ClientInterface
{
    use Authentication;

    private $obj;

    private $response;

    public function __construct()
    {
//       $this->obj = new \COM('SBODI_Server.node') or die ('No connection');
    }

    public function send($xml) {
        $response = '<?xml version="1.0" encoding="UTF-8"?>
                     <env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope">
                        <env:Body>
                            <dis:LoginResponse xmlns:dis="http://www.sap.com/SBO/DIS">
                                <SessionID>0A0E086D-2926-ED9C-DF42-4060B4072B12</SessionID>
                            </dis:LoginResponse>
                        </env:Body>
                     </env:Envelope>';

        // $response = $this->obj->Interact($xml);
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