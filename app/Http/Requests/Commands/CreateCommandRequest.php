<?php

namespace App\Http\Requests\Commands;

use App\Http\Requests\Request;

class CreateCommandRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude' => 'required|regex:/^[+-]?\d+\.\d+, ?[+-]?\d+\.\d+$/',
            'longitude' => 'required|regex:/^[+-]?\d+\.\d+, ?[+-]?\d+\.\d+$/',
            'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',			
			'added' => 'required|date',
			'drone_name' => 'required|exists:drones,name'
        ];
    }
}
