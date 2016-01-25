<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/15/2016
 * Time: 1:00 AM
 */

namespace App\Http\Requests\SensorValues;

use App\Http\Requests\Request;

class SensorValuesCreateRequest extends Request
{
    public function rules()
    {
        return [
			'latitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'value' => 'required|regex:/^\d*(\.\d{2})?$/',
            'added' => 'required|int',
            'sensor_id' => 'required|exists:sensors,id'
        ];
    }
}