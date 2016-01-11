<?php

namespace App\Http\Requests\Sensors;

use App\Http\Requests\Request;

class CreateSensorRequest extends Request
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
            'name' => 'required|unique:sensors|string|max:50',
			'drone_name' => 'required|exists:drones, name'
        ];
    }
}
