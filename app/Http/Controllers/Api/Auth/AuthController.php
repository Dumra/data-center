<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controller;
use JWTAuth;
use App\Http\Requests\Users\LoginUserRequest;

class AuthController extends Controller
{
	protected $jwt;
	
	public function __construct(JWTAuth $jwt)
	{
		$this->jwt = $jwt;
	}
	public function authenticate(LoginUserRequest $request)
    {        
        $credentials = $request->only('email', 'password'); 
        if (! $token = $this->jwt->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
		}		
        return response()->json(compact('token'));
    }
}
