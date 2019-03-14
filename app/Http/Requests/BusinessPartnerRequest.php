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
        $rules = [
            'id' => '',
            'CardCode' => 'required|min:6',
            'CardName' => 'required',
            'CardType' => 'required',
        ];

        return $rules;
    }
}
