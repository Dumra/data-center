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
            'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',
			'battery' => 'integer|between:0,100',
			'added' => 'date',
			'drone_name' => 'exists:drones,name'
        ];
    }
}
