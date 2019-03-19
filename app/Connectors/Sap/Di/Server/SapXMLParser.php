<?php namespace App\Connectors\Sap\Di\Server;

use DOMNode;

class SapXMLParser extends \DOMDocument
{
    protected $wrapper;

    protected $body;

    protected $header;
}