<?php

namespace App\Http\Requests\Drones;

use App\Http\Requests\Request;

class CreateDroneRequest extends Request
{   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'status' => 'string|in:active,inactive',
			'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
			'height' => 'regex:/^\d*(\.\d{2})?$/',
			'battery' => 'integer|between:0,100',
            'type' => 'required|string|in:aircraft,machine',
            'available' => 'boolean'
        ];
    }
}
