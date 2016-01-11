<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:20 PM
 */

namespace App\Data\Repositories\Drones;

use App\Data\Models\Drone;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DroneRepository implements DroneRepositoryInterface
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
            return $this->drone->all();
        }
        try {
            return $this->findByName($name);
        } catch (ModelNotFoundException $e) {
            return "No found result for this query";
        }
    }

    public function destroyDrone($name)
    {
        // TODO: Implement destroyDrone() method.
        try {
            $drone = $this->findByName($name);
            return $drone->delete();
        } catch (ModelNotFoundException $e) {
            return "No found result for this query";
        }
    }

    public function updateDrone($name, $requestArray)
    {
        try {
            $drone = $this->findByName($name);
            $requestArray = $this->prepareToUpdate($requestArray);
            $drone->fill($requestArray);
            return $drone->save();
        } catch (ModelNotFoundException $e) {
            return "No found result for this query";
        }
    }

    public function createDrone($requestArray)
    {
        $requestArray = $this->prepareToUpdate($requestArray);
        $drone = new Drone();
        $drone->fill($requestArray);
        $drone->save();
        return $drone;
    }

    private function findByName($name)
    {
        return $this->drone->where('name', $name)->firstOrFail();
    }

    private function prepareToUpdate($array)
    {
        $resultArray = [];
        $fillableArray = $this->drone->getFillable();
        foreach ($fillableArray as $value) {
            if (array_key_exists($value, $array)) {
                $resultArray[$value] = $array[$value];
            }
        }
        return $resultArray;
    }
}