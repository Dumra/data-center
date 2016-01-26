<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/15/2016
 * Time: 1:00 AM
 */

namespace App\Http\Requests\TaskValues;

use App\Http\Requests\Request;

class TaskValuesCreateRequest extends Request
{
    public function rules()
    {
        return [
			'latitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',
            'longitude' => 'required|regex:/^([0-9.-]+).+?([0-9.-]+)$/',        
			'height' => 'regex:/^\d*(\.\d{2})?$/',
            'direction' => 'in:N,E,S,W,NW,NE,SE,SW',	
            'task_id' => 'required|exists:tasks,id'
        ];
    }
}