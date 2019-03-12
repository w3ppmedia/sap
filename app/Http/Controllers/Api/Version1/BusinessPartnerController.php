<?php namespace App\Http\Controllers\Api\Version1;


use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPartnerRequest;
use App\Entities\BusinessPartner;
use Illuminate\Http\Exceptions\HttpResponseException;

class BusinessPartnerController extends Controller
{
    /**
     * @param BusinessPartnerRequest $businessPartnerRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function post(BusinessPartnerRequest $businessPartnerRequest)
    {
        try {
            $businessPartnerRequest = $businessPartnerRequest->all();
            $businessPartner = BusinessPartner::create($businessPartnerRequest);
            return response()->json($businessPartner->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }
    }
}
