<?php

namespace App\Http\Requests\Commands;

use App\Http\Requests\Request;

class UpdateCommandRequest extends Request
{
	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude' => 'regex:/^[+-]?\d+\.\d+, ?[+-]?\d+\.\d+$/',
            'longitude' => 'regex:/^[+-]?\d+\.\d+, ?[+-]?\d+\.\d+$/',
            'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',			
			'added' => 'date',
			'drone_name' => 'exists:drones,name'
        ];
    }
}
