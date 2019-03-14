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
        'CustomerCode' => 'required',
        'InternalSerialNum' => 'required',
        'Subject' => 'required',
        'CallType' => '',
        // /DO NOT EDIT
    );


}