<?php

namespace App\Data\Repositories\Sensors;

use App\Data\Models\Sensor;
use App\Data\Repositories\AbstractRepository;
use App\Data\Repositories\Drones\DroneRepositoryInterface as DroneRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SensorRepository extends AbstractRepository implements SensorRepositoryInterface
{
    private $sensor;
    private $drone;

    public function __construct(Sensor $sensor, DroneRepository $drone)
    {
        $this->sensor = $sensor;
        $this->drone = $drone;
    }

    public function getSensor($name)
    {
        if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->sensor->all()
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
                'msg' => 'Sensor with this name does not exist'
            ];
        }
    }

    public function getDroneBySensorName($name)
    {
        try {
            $result = $this->findByName($name)->drone;
            return $this->checkResult($result, "No one drones with this sensor");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Sensor with this name does not exit"
            ];
        }
    }

    public function getSensorValuesBySensorName($name)
    {
        try {
            $result = $this->findByName($name)->values;
            return $this->checkResult($result, "Not one values for this sensor");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Sensor with this name does not exit"
            ];
        }
    }

    public function createSensor($array)
    {
        $drone = $this->drone->getDroneBy('name', $array['drone_name']);
        $droneResult = $drone['data'];
        $requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());
        if (isset($requestArray['drone_id'])) {
            unset($requestArray['drone_id']);
        }
        $requestArray['drone_id'] = $droneResult->id;
        $droneCreated = $droneResult->sensors()->save($this->sensor->create($requestArray));
        return ['success' => true,
                'data' => $droneCreated];
    }

    public function updateSensor($array, $name)
    {
        try {
            $sensor = $this->findByName($name);
            $drone = $this->drone->getDroneBy('name', $array['drone_name']);
            $droneResult = $drone['data'];
            $requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());
            if (isset($requestArray['drone_id'])) {
                unset($requestArray['drone_id']);
            }
            $requestArray['drone_id'] = $droneResult->id;
            $sensor->fill($requestArray);
            return ['success' => $sensor->save(),
                    'data' => $sensor];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This sensor does not exit"
            ];
        }
    }

    public function deleteSensor($name)
    {
        try {
            $sensor = $this->findByName($name);
            return ['success' => $sensor->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "This drone does not exit"
            ];
        }
    }

    private function findByName($name)
    {
        return $this->sensor->where('name', $name)->firstOrFail();
    }
}
