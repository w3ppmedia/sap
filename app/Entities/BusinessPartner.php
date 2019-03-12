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
        'name' => 'required',
        'description' => '',
        // /DO NOT EDIT
    );
}
