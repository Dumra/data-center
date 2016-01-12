<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:20 PM
 */

namespace App\Data\Repositories\Drones;

use App\Data\Models\Drone;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DroneRepository extends AbstractRepository implements DroneRepositoryInterface
{
    private $drone;

    public function __construct(Drone $drone)
    {
        $this->drone = $drone;
    }

    public function getDrone($name)
    {
        // TODO: Implement getDrone() method.
        if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->drone->all()
            ];
        }
        try {
            return [
                'success' => true,
                'data' => $this->findByName($name)
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
    }

    public function destroyDrone($name)
    {
        // TODO: Implement destroyDrone() method.
        try {
            $drone = $this->findByName($name);
            return ['success' => $drone->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "Drone with this name does not exist"
            ];
        }
    }

    public function updateDrone($name, $requestArray)
    {
        try {
            $drone = $this->findByName($name);
            $requestArray = $this->prepareToUpdate($requestArray, $this->drone->getFillable());
            $drone->fill($requestArray);
            return ['success' => $drone->save()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "Drone with this name does not exist"
            ];
        }
    }

    public function createDrone($requestArray)
    {
        $requestArray = $this->prepareToUpdate($requestArray, $this->drone->getFillable());
        $drone = $this->drone->create($requestArray);
        return [
            'success' => true,
            'data' => $drone
        ];
    }

    public function getDroneBy($field, $value)
    {
        $result = $this->findBy($field, $value);
        return $this->checkResult($result, "Drone where $field = $value does not exist");
    }

    public function getSensorsByDroneName($name)
    {
        try {
            $result = $this->drone->where('name', $name)->firstOrFail()->sensors;
            return $this->checkResult($result, "Not one sensors one this drone");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Drone with this name does not exit"
            ];
        }
    }

    public function getRoutesByDroneName($name)
    {
        try {
            $result = $this->drone->where('name', $name)->firstOrFail()->routes;
            return $this->checkResult($result, "Not one routes with this drone");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Drone with this name does not exit"
            ];
        }
    }

    public function getCommandsByDroneName($name)
    {
        try {
            $result = $this->drone->where('name', $name)->firstOrFail()->commands;
            return $this->checkResult($result, "Not one commands with this drone");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Drone with this name does not exit"
            ];
        }
    }

    private function findBy($field, $value)
    {
        if ($field === 'name') {
            return $this->drone->where($field, $value)->firstOrFail();
        }
        return $this->drone->where($field, $value)->get();
    }

    private function findByName($name)
    {
        return $this->drone->where('name', $name)->firstOrFail();
    }

}