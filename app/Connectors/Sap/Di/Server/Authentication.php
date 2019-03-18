<?php namespace App\Connectors\Sap\Di\Server;

trait Authentication
{
    private $client;

    private $session;

    public function connect()
    {
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <env:Envelope xmlns:env=\"http://schemas.xmlsoap.org/soap/envelope/\">
                   <env:Body>
                      <dis:Login xmlns:dis=\"http://www.sap.com/SBO/DIS\">
                         <DatabaseServer>p5053655</DatabaseServer>
                         <DatabaseName>SBODemo_US</DatabaseName>
                         <DatabaseType>dst_MSSQL</DatabaseType>
                         <DatabaseUsername>sa</DatabaseUsername>
                         <DatabasePassword />
                         <CompanyUsername>manager</CompanyUsername>
                         <CompanyPassword>manager</CompanyPassword>
                         <Language>ln_English</Language>
                         <LicenseServer>ILTLVH25</LicenseServer>
                      </dis:Login>
                   </env:Body>
                </env:Envelope>";

        $response = $this->client->send($xml);

        var_dump($response);
    }
}