<?php

namespace App\Http\Requests\Drones;

use App\Http\Requests\Request;

class UpdateDroneRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:50',
            'status' => 'string|in:active,inactive',
			'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
			'battery' => 'integer|between:0,100',
            'type' => 'string|in:aircraft, machine',
            'available' => 'boolean'
        ];
    }
}
