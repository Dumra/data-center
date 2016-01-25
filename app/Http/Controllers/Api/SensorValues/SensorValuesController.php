<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 11:15 PM
 */

namespace App\Http\Controllers\Api\SensorValues;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\SensorValues\SensorValueRepositoryInterface;
use App\Http\Requests\SensorValues\SensorValuesCreateRequest;
use App\Http\Requests\SensorValues\SensorValuesUpdateRequest;
use Illuminate\Http\Request;

class SensorValuesController extends AbstractApiController
{
    public function __construct(SensorValueRepositoryInterface $sensorVal)
    {
        $this->model = $sensorVal;
    }

    public function getValueByDate(Request $request, $sensorId, $date, $dateEnd = null)
    {
        return $this->sendResponse($this->model->getByDate($sensorId, $date, $dateEnd), $request);
    }

    public function createValue(SensorValuesCreateRequest $request)
    {
        return $this->create($request);
    }

    public function updateValue(SensorValuesUpdateRequest $request, $id)
    {
        return $this->update($request, $id);
    }
}