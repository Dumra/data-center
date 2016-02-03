<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Http\Requests\Users\LoginUserRequest;

class AuthController extends Controller
{
    public function authenticate(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false, 'data' => 'invalid_credentials'], 401);
        }
        return response()->json(['success' => true, 'token' => $token]);
    }
}
