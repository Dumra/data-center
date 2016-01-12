<?php

namespace App\Http\Requests\Routes;

use App\Http\Requests\Request;

class UpdateRouteRequest extends Request
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
			'battery' => 'integer|between:0,100',
			'added' => 'date',
			'drone_name' => 'exists:drones,name'
        ];
    }
}
