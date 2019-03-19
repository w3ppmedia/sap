<?php namespace App\Http\Controllers\Api\Version1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthLogoutRequest;
use App\Connectors\Sap\Di\Server\Client;
use App\Connectors\Sap\Di\Server\Connector;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $authRequest) {
        $authRequest = $authRequest->all();

        $connector = new Connector(new Client());
        $sessionId = $connector->login($authRequest);

        return response()->json(['SessionId' => $sessionId]);
    }

    public function logout(AuthLogoutRequest $authLogoutRequest) {
        $authLogoutRequest = $authLogoutRequest->all();

        $connector = new Connector(new Client());

        if (!$connector->logout($authLogoutRequest['SessionId'])) {
            return response()->json(['message' => 'Unable to logout']);
        };

        return response()->json(['message' => 'Successfully logged out']);
    }
}