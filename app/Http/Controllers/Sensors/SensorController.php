<?php

namespace App\Http\Controllers\Sensors;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Sensors\SensorRepositoryInterface;
use App\Http\Requests\Sensors\CreateSensorRequest;
use App\Http\Requests\Sensors\UpdateSensorRequest;

class SensorController extends Controller
{
    private $sensor;

    public function __construct(SensorRepositoryInterface $sensor)
    {
        $this->sensor = $sensor;
    }

    public function getSensor($name = null)
    {
        return response($this->sensor->getSensor($name));
    }

    public function getDroneBySensorName($name)
    {
        return response($this->sensor->getDroneBySensorName($name));
    }

    public function getSensorValuesBySensorName($name)
    {
        return response($this->sensor->getSensorValuesBySensorName($name));
    }

    public function createSensor(CreateSensorRequest $request)
    {
        return response($this->sensor->createSensor($request->all()));
    }

    public function updateSensor(UpdateSensorRequest $request, $name)
    {
        return response($this->sensor->updateSensor($request->all(), $name));
    }

    public function deleteSensor($name)
    {
        return response($this->sensor->deleteSensor($name));
    }
}
