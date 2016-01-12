<?php

namespace App\Http\Controllers\Drones;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Http\Requests\Drones\UpdateDroneRequest;
use App\Http\Requests\Drones\CreateDroneRequest;

class DroneController extends Controller
{
    private $drone;

    public function __construct(DroneRepositoryInterface $drone)
    {
        $this->drone = $drone;
    }

    public function getDrone($name = null)
    {
        return response($this->drone->getDrone($name));
    }

    public function getDroneByType($type)
    {
        return response($this->drone->getDroneBy('type', $type));
    }

    public function getSensorsByDroneName($droneName)
    {
        return response($this->drone->getSensorsByDroneName($droneName));
    }

    public function getRoutesByDroneName($droneName)
    {
        return response($this->drone->getRoutesByDroneName($droneName));
    }

    public function getCommandsByDroneName($droneName)
    {
        return response($this->drone->getCommandsByDroneName($droneName));
    }

    public function getDroneByStatus($status)
    {
        return response($this->drone->getDroneBy('status', $status));
    }

    public function getDroneByAvailable($available)
    {
        return response($this->drone->getDroneBy('available', $available));
    }

    public function createDrone(CreateDroneRequest $request)
    {
        return response($this->drone->createDrone($request->all()));
    }

    public function updateDrone(UpdateDroneRequest $request, $name)
    {
        return response($this->drone->updateDrone($name, $request->all()));
    }

    public function deleteDrone($name)
    {
        return response($this->drone->destroyDrone($name));
    }

}