<?php namespace App\Connectors\Sap\Di\Server;

use App\Connectors\Sap\Di\Server\Handlers\Request;

class Builder extends Runner
{
    protected $client;

    protected $request;

    protected $table;

    public function __construct(Connector $connector)
    {
        $this->client = $connector->getClient();

        $this->request = new Request('1.0', 'UTF-16');
        $this->request->addToHeader('SessionID', $this->client->getSession());
    }

    public function prepQueryRequest() {
        $this->request->withBodyElement();
    }

    public function table($table) {
        $this->table = $table;
        $this->request->setOType('o'.$table);

        return $this;
    }

    public function where($query = array()) {
        if (!empty($query)) {
            $this->request->setQueryParams($query);
        }

        return $this;
    }

    public function insert($data) {
        $this->request->withBodyElement();
        $this->set($data);

        $this->process();
    }

    public function update($data) {
        $this->request->withBodyElement('UpdateObject');
        $this->set($data);

        $this->process();
    }

    public function set($data = array()) {
        $primaryBusinessObject = $this->request->addToBusinessObject($this->table);
        $row = $this->request->createElement('row');

        $primaryBusinessObject->appendChild($row);

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            if (is_array($value)) {
                $secondaryBusinessObject = $this->request->addToBusinessObject($key);

                foreach ($value as $lines) {
                    $this->row($lines, function ($row) use ($secondaryBusinessObject) {
                        $secondaryBusinessObject->appendChild($row);
                    });
                }
            } else {
                $entry = $this->request->createElement($key, $value);
                $row->appendChild($entry);
            }
        }
    }

    public function row($array = array(), $callback) {
        if (is_callable($callback)) {
            $row = $this->request->createElement('row');

            foreach ($array as $key => $value) {
                $entry = $this->request->createElement($key, $value);
                $row->appendChild($entry);
            }

            call_user_func($callback, $row);
        }
    }

    public function find() {}
}