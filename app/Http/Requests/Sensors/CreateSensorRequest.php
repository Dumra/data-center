<?php

namespace App\Http\Requests\Sensors;

use App\Http\Requests\Request;

class CreateSensorRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50|regex:/^[\S]+$/',
			'drone_id' => 'required|exists:drones,id'
        ];
    }
}
