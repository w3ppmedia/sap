<?php namespace App\Http\Controllers\Api\Version1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthLogoutRequest;
use App\Connectors\Sap\Di\Server\Connector;

class AuthController extends Controller
{
    /**
     * @var Connector
     */
    private $connector;

    /**
     * AuthController constructor.
     * @param Connector $connector
     */
    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param AuthLoginRequest $authRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $authRequest) {
        $authRequest = $authRequest->all();
        $this->connector->createClientSession($authRequest);

        return response()->json(['SessionId' => $this->connector->getClientSession()]);
    }

    /**
     * @param AuthLogoutRequest $authLogoutRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(AuthLogoutRequest $authLogoutRequest) {
        $authLogoutRequest = $authLogoutRequest->all();

        if (!$this->connector->destroyClientSession($authLogoutRequest['SessionId'])) {
            return response()->json(['message' => 'Unable to logout']);
        };

        return response()->json(['message' => 'Successfully logged out']);
    }
}