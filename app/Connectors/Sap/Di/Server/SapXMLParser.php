<?php namespace App\Connectors\Sap\Di\Server;

use DOMNode;

class SapXMLParser extends \DOMDocument
{
    protected $wrapper;

    protected $body;

    protected $header;

    public function saveXML(DOMNode $node = null, $options = null)
    {
    	$xml = parent::saveXML($node, $options);
        return mb_convert_encoding($xml, 'UTF-8', 'UTF-16');
    }
}