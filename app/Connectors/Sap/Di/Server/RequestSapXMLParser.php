<?php namespace App\Connectors\Sap\Di\Server;

class RequestSapXMLParser extends SapXMLParser
{
    public function __construct ($version, $encoding){
        parent::__construct($version, $encoding);

        $this->setUp();
    }

    public function addToBodyNS($namespaceURI, $qualifiedName) {
        $item = $this->createElementNS($namespaceURI, $qualifiedName);
        $this->body->appendChild($item);

        return $item;
    }

    public function addToHeader($name, $value) {
        $item = $this->createElement($name, $value);
        $this->header->appendChild($item);

        return $item;
    }

    private function setUp() {
        $this->wrapper = $this->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'env:Envelope');
        $this->appendChild($this->wrapper);

        $this->header = $this->createElement('env:Header');
        $this->wrapper->appendChild($this->header);

        $this->body = $this->createElement('env:Body');
        $this->wrapper->appendChild($this->body);
    }
}