<?php

namespace App\Http\Requests\Drones;

use App\Http\Requests\Request;

class CreateDroneRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:drones|string|max:50',
            'status' => 'string|in:active,inactive',
            'type' => 'required|string|in:aircraft, machine',
            'available' => 'boolean',
        ];
    }
}
