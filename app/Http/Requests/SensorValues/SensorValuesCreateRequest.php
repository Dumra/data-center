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
            'value' => 'required|regex:/^\d*(\.\d{2})?$/',
            'added' => 'required|date',
            'sensor_name' => 'required|exists:sensors,name'
        ];
    }
}