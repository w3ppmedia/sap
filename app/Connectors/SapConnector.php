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
     *
     * @param array $configs
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
				throw new Exception($this->get_error($lRetCode));
			}

		} catch (com_exception $e) {
		    throw $e;
		}
	}

    /**
     * @param int $errCode
     * @return string
     */
    public function get_error($errCode = 0) {
        if ($this->errMsg == '') {
            $this->set_error($errCode);
        }

        return $this->errMsg;
    }

    /**
     * @param $errCode
     */
    protected function set_error($errCode) {
        $this->sapCom->GetLastError($errCode, $this->errMsg);

        var_dump($this->errMsg);
        die();

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

    public function insert() {

    }

    public function update() {}
}