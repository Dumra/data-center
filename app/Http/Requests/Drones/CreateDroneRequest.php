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
            'type' => 'required|string|in:aircraft, machine',
            'available' => 'boolean'
        ];
    }
}
