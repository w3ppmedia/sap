<?php namespace App\Http\Controllers\Api\Version1;


use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCallRequest;
use App\Entities\ServiceCall;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceCallController extends Controller
{
    /**
     * @param ServiceCallRequest $serviceCallRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function post(ServiceCallRequest $serviceCallRequest)
    {
        try {
            $serviceCallRequest = $serviceCallRequest->all();
            $serviceCall = ServiceCall::create($serviceCallRequest);
            return response()->json($serviceCall->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }
    }
}