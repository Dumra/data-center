<?php

namespace App\Http\Controllers\Api\Sensors;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Sensors\SensorRepositoryInterface;
use App\Http\Requests\Sensors\CreateSensorRequest;
use App\Http\Requests\Sensors\UpdateSensorRequest;
use Illuminate\Http\Request;

class SensorController extends AbstractApiController
{
    public function __construct(SensorRepositoryInterface $sensor)
    {
        $this->model = $sensor;
    }

    public function getDroneBySensorName(Request $request, $id)
    {
        return $this->sendResponse($this->model->getDroneBySensorName($id), $request);
    }

    public function getSensorValuesBySensorName(Request $request, $id)
    {
        return $this->sendResponse($this->model->getSensorValuesBySensorName($id), $request);
    }

    public function createSensor(CreateSensorRequest $request)
    {
        return $this->create($request);
    }

    public function updateSensor(UpdateSensorRequest $request, $id)
    {
        return $this->update($request, $id);
    }
}
