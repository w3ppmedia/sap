<?php namespace App\Entities;


class BusinessPartner extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 16;

    /**
     * @var array
     */
    protected $validation = array(
        // DO NOT EDIT
        'id' => '',
        'cardCode' => 'required',
        'cardName' => '',
        // /DO NOT EDIT
    );
}
