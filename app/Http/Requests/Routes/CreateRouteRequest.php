<?php

namespace App\Http\Requests\Routes;

use App\Http\Requests\Request;

class CreateRouteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',
			'battery' => 'required|integer|between:0,100',
			'added' => 'required|date',
			'drone_id' => 'required|exists:drones,id'
        ];
    }
}
