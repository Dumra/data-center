<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/15/2016
 * Time: 1:02 AM
 */

namespace App\Http\Requests\TaskValues;

use App\Http\Requests\Request;

class TaskValuesUpdateRequest extends Request
{
    public function rules()
    {
        return [
			'latitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',           
            'task_id' => 'exists:tasks,id'
        ];
    }
}