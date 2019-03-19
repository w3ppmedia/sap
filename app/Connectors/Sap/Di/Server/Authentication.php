<?php namespace App\Connectors\Sap\Di\Server;

trait Authentication
{
    private $sessionId;

    private $credentials = array(
        'DatabaseServer' => 'SAPSERVER',
        'DatabaseName' => 'PENTA_LIVE',
        'DatabaseType' => 6,
        'CompanyUsername' => 'dir002',
        'CompanyPassword' => 'nivek',
        'Language' => 'ln_English',
        'LicenseServer' => 'SAPSERVER:30000'
    );

    protected function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getSession() {
        return $this->sessionId;
    }

    public function login($credentials = array())
    {
        $xml = new RequestSapXMLParser('1.0', 'UTF-16');
        $login = $xml->addToBodyNS('http://www.sap.com/SBO/DIS', 'dis:Login');

        foreach (array_replace($this->credentials, $credentials) as $name => $value) {
            $login->appendChild($xml->createElement($name, $value));
        }

        $this->send($xml->saveXML());
        $this->setSessionId($this->getResponse()->getValueByQuery('xmlns:LoginResponse/xmlns:SessionID'));
    }

    public function logout($sessionId) {
        $xml = new RequestSapXMLParser('1.0', 'UTF-8');
        $xml->addToHeader('SessionID', $sessionId);
        $xml->addToBodyNS('http://www.sap.com/SBO/DIS', 'dis:Logout');

        var_dump($xml->saveXML());
    }
}