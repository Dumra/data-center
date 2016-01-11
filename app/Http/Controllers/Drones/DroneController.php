<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:27 PM
 */

namespace App\Http\Controllers\Drones;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Http\Requests\UpdateDroneRequest;
use App\Http\Requests\CreateDroneRequest;

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

    public function createDrone(CreateDroneRequest $request)
    {
        return response($this->drone->createDrone($request->all()));
    }

    public function updateDrone(UpdateDroneRequest $request, $name)
    {
        return ['success' => $this->drone->updateDrone($name, $request->all())];
    }

    public function deleteDrone($name)
    {
        return ['success' => $this->drone->destroyDrone($name)];
    }

}