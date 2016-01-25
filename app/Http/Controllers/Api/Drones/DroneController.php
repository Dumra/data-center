<?php

namespace App\Http\Controllers\Api\Drones;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Http\Requests\Drones\UpdateDroneRequest;
use App\Http\Requests\Drones\CreateDroneRequest;
use Illuminate\Http\Request;

class DroneController extends AbstractApiController
{
    public function __construct(DroneRepositoryInterface $drone)
    {
        $this->model = $drone;
    }

    public function getByType(Request $request, $type)
    {
        return $this->sendResponse($this->model->getBy('type', $type), $request);
    }

    public function getSensors(Request $request, $droneId)
    {
        return $this->sendResponse($this->model->getDependences($droneId, 'sensors'), $request);
    }

    public function getRoutes(Request $request, $droneId)
    {
        return $this->sendResponse($this->model->getDependences($droneId, 'routes'), $request);
    }

    public function getCommands(Request $request, $droneId)
    {
        return $this->sendResponse($this->model->getDependences($droneId, 'commands'), $request);
    }

    public function getByStatus(Request $request, $status)
    {
        return $this->sendResponse($this->model->getBy('status', $status), $request);
    }

    public function getByAvailable(Request $request, $available)
    {
        return  $this->sendResponse($this->model->getBy('available', $available), $request);
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