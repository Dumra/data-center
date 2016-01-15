<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class LoginUserRequest extends Request
{
	public function rules()
    {
        return [
            'email' => 'required|email',
			'password' => 'required|min:6'
        ];
    }
}
