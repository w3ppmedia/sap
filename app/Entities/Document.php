<?php namespace App\Entities;

class Document extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 'Documents';

    /**
     * @var string
     */
    protected $primaryKey = 'AbsEntry';


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
        13 => "Invoices", // correct
        14 => "CreditNotes", // correct
        15 => "DeliveryNotes", // correct
        16 => "Returns", // correct
        17 => "Orders", // and so on lol
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