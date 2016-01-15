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

    public function getDroneBySensorName($name)
    {
        return response($this->model->getDroneBySensorName($name));
    }

    public function getSensorValuesBySensorName($name)
    {
        return response($this->model->getSensorValuesBySensorName($name));
    }

    public function createSensor(CreateSensorRequest $request)
    {
        return $this->create($request);
    }

    public function updateSensor(UpdateSensorRequest $request, $name)
    {
        return $this->update($request, $name);
    }
}
