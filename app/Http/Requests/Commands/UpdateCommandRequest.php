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
           // 'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
           // 'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
			'description' => 'string|max:250',
			'status' => 'in:opened,in progress,failed,closed',
           // 'height' => 'regex:/^\d*(\.\d{2})?$/',
           // 'direction' => 'in:N,E,S,W,NW,NE,SE,SW',			
			'added' => 'int',
			'drone_id' => 'exists:drones,id'
        ];
    }
}
