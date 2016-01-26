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

    public function get($id)
    {
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->sensor->all()
            ];
        }
        try {
            return [
                'success' => true,
                'data' => $this->findById($id)
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Sensor with this id does not exist'
            ];
        }
    }

    public function getDroneBySensorName($id)
    {
        try {
            $result = $this->findById($id)->drone;
            return $this->checkResult($result, "No one drones with this sensor");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Sensor with this id does not exit"
            ];
        }
    }

    public function getSensorValuesBySensorName($id)
    {
        try {
            $result = $this->findById($id)->values;
            return $this->checkResult($result, "Not one values for this sensor");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Sensor with this id does not exit"
            ];
        }
    }

    public function create($array)
    {
		$droneResult = $this->drone->get($array['drone_id']);
        $drone = $droneResult['data'];      
        $requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());        
        $droneCreated = $drone->sensors()->save($this->sensor->create($requestArray));
        return ['success' => true,
                'data' => $droneCreated];
    }

    public function update($id, $array)
    {
        try {
            $sensor = $this->findById($id);     
            $requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());          
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

    public function delete($id)
    {
        try {
            $sensor = $this->findById($id);
            return ['success' => $sensor->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "This sensor does not exit"
            ];
        }
    }
	
	public function findById($id)
    {
        return $this->sensor->findOrFail($id);
    }
}
