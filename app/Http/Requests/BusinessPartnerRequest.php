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
        return [
            'id' => '',
            'cardCode' => 'required',
            'cardName' => ''
        ];
    }
}
