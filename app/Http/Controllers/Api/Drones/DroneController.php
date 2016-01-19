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
        return response($this->model->getBy('type', $type));
    }

    public function getSensors($droneId)
    {
        return response($this->model->getDependences($droneId, 'sensors'));
    }

    public function getRoutes($droneId)
    {
        return response($this->model->getDependences($droneId, 'routes'));
    }

    public function getCommands($droneId)
    {
        return response($this->model->getDependences($droneId, 'commands'));
    }

    public function getByStatus($status)
    {
        return response($this->model->getBy('status', $status));
    }

    public function getByAvailable($available)
    {
        return response($this->model->getBy('available', $available));
    }

    public function createDrone(CreateDroneRequest $request)
    {
        return $this->create($request);
    }

     public function updateDrone(UpdateDroneRequest $request, $id)
     {
         return $this->update($request, $id);
     }

}