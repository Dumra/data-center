<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/15/2016
 * Time: 1:02 AM
 */

namespace App\Http\Requests\SensorValues;

use App\Http\Requests\Request;

class SensorValuesUpdateRequest extends Request
{
    public function rules()
    {
        return [
			'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'value' => 'regex:/^\d*(\.\d{2})?$/',
            'added' => 'int',
            'sensor_id' => 'exists:sensors,id'
        ];
    }
}