<?php namespace App\Http\Requests;

class ServiceCallRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'CustomerCode' => 'required',
            'InternalSerialNum' => 'required',
            'Subject' => 'required'
        ];

        return $rules;
    }
}