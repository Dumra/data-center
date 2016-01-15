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
            'value' => 'regex:/^\d*(\.\d{2})?$/',
            'added' => 'date',
            'sensor_name' => 'exists:sensors,name'
        ];
    }
}