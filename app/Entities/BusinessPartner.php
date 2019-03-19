<?php namespace App\Entities;


class BusinessPartner extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 'BusinessPartners';

    /**
     * @var array
     */
    protected $validation = array(
        // DO NOT EDIT
        'id' => '',
        'CardCode' => '',
        'CardName' => '',
        'CardType' => 'integer|between:0,2',
        // /DO NOT EDIT
    );
}
