<?php namespace App\Entities;

class Document extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 'Documents';

    /**
     * @var array
     */
    protected $validation = array(
        // DO NOT EDIT
        'id' => '',
        'CustomerCode' => '',
        'ItemCode' => '',
        'InternalSerialNum' => '',
        'Subject' => '',
        'CallType' => '',
        // /DO NOT EDIT
    );

    /**
     * @var array
     */
    public $docs = array(
        13 => "Invoices",
        14 => "CreditNotes",
        15 => "DeliveryNotes",
        16 => "Returns",
        17 => "Orders",
        18 => "PurchaseInvoices",
        19 => "PurchaseCreditNotes",
        20 => "PurchaseDeliveryNotes",
        21 => "PurchaseReturns",
        22 => "PurchaseOrders",
        23 => "Quotations",
    );

    public function preCreateHook($data)
    {
        if (isset($this->docs[$data['DocType']])) {
            $this->table = $this->table.'.'.$this->docs[$data['DocType']];
        }

        return parent::preCreateHook($data);
    }
}