<?php namespace App\Connectors\Sap\Di\Server;

abstract class Builder
{
    protected $clientRequest;

    protected $requestObject;

    protected $AdmInfo;

    protected $table;

    protected $bo;

    public function prepQueryRequest() {
        $this->clientRequest = new RequestSapXMLParser('1.0', 'UTF-16');
        $this->clientRequest->addToHeader('SessionID', '4E7286AF-F906-47DC-8717-9A7631242E56');
        $this->clientRequest->addToBodyNS('http://www.sap.com/SBO/DIS', 'dis:AddObject');

        $this->bo = $this->clientRequest->createElement('BO');

        $bom = $this->clientRequest->addToBody('BOM');
        $bom->appendChild($this->bo);

        $this->AdmInfo = $this->clientRequest->createElement('AdmInfo');
        $this->bo->appendChild($this->AdmInfo);
    }

    public function find() {}

    public function table($table) {
        $this->prepQueryRequest();
        $this->table = $table;

        $object = $this->clientRequest->createElement('Object', 'o'.$table);
        $this->AdmInfo->appendChild($object);

        return $this;
    }

    public function where() {
        $this->prepQueryRequest();
    }

    public function insert($data) {
        $parentObj = $this->clientRequest->createElement($this->table);
        $row = $this->clientRequest->createElement('row');
        $parentObj->appendChild($row);
        $this->bo->appendChild($parentObj);

        foreach ($data as $key => $value) {
            $this->clientRequest->addToObject($key, $value, $row);
        }

        $this->process();
    }

    public function process() {
        $this->client->sendRequest($this->clientRequest->saveXml());
    }

    public function update() {}

    public abstract function getClientSession();
}