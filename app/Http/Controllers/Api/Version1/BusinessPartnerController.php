<?php namespace App\Http\Controllers\Api\Version1;


use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPartnerRequest;
use App\Entities\BusinessPartner;
use App\Models\BusinessPartners;
use Illuminate\Http\Exceptions\HttpResponseException;

class BusinessPartnerController extends Controller
{

    private $businessPartnerModel;

    public function __construct(BusinessPartners $businessPartners) {
        $this->businessPartnerModel = $businessPartners;
    }

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

    /**
     * @param $id
     * @param BusinessPartnerRequest $businessPartnerRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function put($id, BusinessPartnerRequest $businessPartnerRequest)
    {
        $businessPartner = $this->businessPartnerModel->findById($id);

        try {
            $businessPartnerRequest = $businessPartnerRequest->all();
            $businessPartner->update($businessPartnerRequest);
            return response()->json($businessPartner->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }
    }
}
