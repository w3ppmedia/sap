<?php namespace App\Entities;

class ServiceCall extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 191;

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
}