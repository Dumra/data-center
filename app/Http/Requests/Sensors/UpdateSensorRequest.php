<?php

namespace App\Http\Requests\Sensors;

use App\Http\Requests\Request;

class UpdateSensorRequest extends Request
{   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:50|regex:/^[\S]+$/',
			'drone_id' => 'exists:drones,id'
        ];
    }
}
