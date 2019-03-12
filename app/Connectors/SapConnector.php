<?php namespace App\Connectors;

use mysql_xdevapi\Exception;

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

			if ($this->sapCom instanceof \stdClass) {
                $this->sapCom->server = "SAPSERVER";
                $this->sapCom->CompanyDB = $configs['companyDb'];
                $this->sapCom->username = $configs['username'];
                $this->sapCom->password = $configs['password'];
                $this->sapCom->DbServerType = "6";
            }

			$lRetCode = $this->sapCom->Connect;

			if ($lRetCode != 0) {
				throw new Exception($this->get_error());
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