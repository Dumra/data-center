<?php

namespace App\Http\Controllers\Api\Sensors;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Sensors\SensorRepositoryInterface;
use App\Http\Requests\Sensors\CreateSensorRequest;
use App\Http\Requests\Sensors\UpdateSensorRequest;

class SensorController extends AbstractApiController
{
    public function __construct(SensorRepositoryInterface $sensor)
    {
        $this->model = $sensor;
    }

    public function getDroneBySensorName($id)
    {
        return response($this->model->getDroneBySensorName($id));
    }

    public function getSensorValuesBySensorName($id)
    {
        return response($this->model->getSensorValuesBySensorName($id));
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
