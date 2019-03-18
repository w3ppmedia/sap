<?php namespace App\Http\Requests;

class BusinessPartnerRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST': {
                return [
                    'id' => '',
                    'CardCode' => 'required|min:6',
                    'CardName' => 'required',
                    'CardType' => 'required',
                ]; 
            }
            case 'PUT': {
                return [];
            }    
        }
    }
}
