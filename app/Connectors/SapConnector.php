<?php namespace App\Connectors;

use Exception;

class SapConnector {

	protected $businessObj;

	protected $sapCom;

	protected $retCode;

	public $errCode = 0;

	public $errMsg = '';

    /**
     * SapConnector constructor.
     * @param array $configs
     * @throws Exception
     */
    public function __construct(array $configs = array()) {
		try {
			$this->sapCom = new \COM("SAPbobsCOM.company") or die ("No connection");

            $this->sapCom->DbServerType = "6";
            $this->sapCom->server = "SAPSERVER";
            $this->sapCom->CompanyDB = $configs['database'];
            $this->sapCom->username = $configs['username'];
            $this->sapCom->password = $configs['password'];

			$lRetCode = $this->sapCom->Connect;

			if ($lRetCode != 0) {
				throw new Exception($this->getError($lRetCode));
			}

		} catch (com_exception $e) {
		    throw $e;
		}
	}

    /**
     * @param int $errCode
     * @return string
     */
    public function getError($errCode = 0) {
        if ($this->errMsg == '') {
            $this->setError($errCode);
        }

        return $this->errMsg;
    }

    /**
     * @param $errCode
     */
    protected function setError($errCode) {
        $this->sapCom->GetLastError($errCode, $this->errMsg);

        if ($this->errMsg == '') {
            $this->errMsg = $this->sapCom->GetLastErrorDescription();
        }
    }

    public function table($name) {
        $this->businessObj = $this->sapCom->GetBusinessObject($name);
        return $this;
    }

    public function where($id, $itemTypeCode = 0) {
        if ($itemTypeCode == 0) {
            if (strlen($id) > 15) {
                throw new Exception('Key is out of index');
            }
        }

        try {
            if (!$this->businessObj->GetByKey($id)) {
                throw new Exception('Objects not found');
            }
        } catch (com_exception $e) {
            throw $e;
        }

        return $this;
    }

    public function insert($data) {
        try {
            foreach ($data as $key => $value) {
                $this->setProperties($key, $value);
            }

            $RetCode = $this->businessObj->add();

            if ($RetCode == 0) {
                return $this->sapCom->GetNewObjectKey();
            } else {
                throw new Exception($this->get_error($RetCode));
            }
        } catch (com_exception $e) {
            throw new $e;
        }
    }

    public function update() {}

    private function setProperties ($key, $value, $parent = null) {
        if (is_array($value)) {
            $parent = $key;

            foreach ($value as $line) {
                foreach ($line as $key => $item) {
                    $this->setProperties($key, $item, $parent);
                }
            }
        }

        if (is_null($parent)) {
            $this->businessObj->$key = $value;
        } else {
            $this->businessObj->$parent->$key = $value;
        }
    }
}