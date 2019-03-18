<?php namespace App\Connectors\Sap\Di\Server;

trait Authentication
{
    private $session;

    public function connect()
    {
        $xml = '<?xml version="1.0" encoding="UTF-16"?>
                <env:Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/">
                   <env:Body>
                      <dis:Login xmlns:dis="http://www.sap.com/SBO/DIS">
                         <DatabaseServer>SAPSERVER</DatabaseServer>
                         <DatabaseName>PENTA_LIVE</DatabaseName>
                         <DatabaseType>6</DatabaseType>
                         <CompanyUsername>dir002</CompanyUsername>
                         <CompanyPassword>nivek</CompanyPassword>
                         <Language>ln_English</Language>
                         <LicenseServer>SAPSERVER:30000</LicenseServer>
                      </dis:Login>
                   </env:Body>
                </env:Envelope>';

        // $response = $this->send($xml);

        var_dump($response);
    }

    public function send() {}
}