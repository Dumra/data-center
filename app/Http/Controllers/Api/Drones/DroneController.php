<?php

namespace App\Http\Controllers\Api\Drones;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Http\Requests\Drones\UpdateDroneRequest;
use App\Http\Requests\Drones\CreateDroneRequest;

class DroneController extends AbstractApiController
{
    public function __construct(DroneRepositoryInterface $drone)
    {
        $this->model = $drone;
    }

    public function getByType($type)
    {
        return response($this->model->getDroneBy('type', $type));
    }

    public function getSensors($droneName)
    {
        return response($this->model->getDependences($droneName, 'sensors'));
    }

    public function getRoutes($droneName)
    {
        return response($this->model->getDependences($droneName, 'routes'));
    }

    public function getCommands($droneName)
    {
        return response($this->model->getDependences($droneName, 'commands'));
    }

    public function getByStatus($status)
    {
        return response($this->model->getDroneBy('status', $status));
    }

    public function geteByAvailable($available)
    {
        return response($this->model->getDroneBy('available', $available));
    }

    public function createDrone(CreateDroneRequest $request)
    {
        return $this->create($request);
    }

     public function updateDrone(UpdateDroneRequest $request, $name)
     {
         return $this->update($request, $name);
     }

}