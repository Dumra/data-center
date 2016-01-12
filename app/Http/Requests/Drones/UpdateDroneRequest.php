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
            'name' => 'unique:drones|string|max:50|regex:/^[\S]+$/',
            'status' => 'string|in:active,inactive',
            'type' => 'string|in:aircraft, machine',
            'available' => 'boolean',
        ];
    }
}
