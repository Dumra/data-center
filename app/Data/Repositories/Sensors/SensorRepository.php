<?php

namespace App\Data\Repositories\Sensors;

use App\Data\Models\Sensor;
use App\Data\Repositories\AbstractRepository;
use App\Data\Repositories\Drones\DroneRepositoryInterface as DroneRepository;

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
            return ['success' => true,
					'data' => $this->sensor->all()];
        }
        try {
            return ['success' => true,
					'data' => $this->findByName($name)];
        } catch (ModelNotFoundException $e) {
            return [
				'success' => false,
				'msg' => "No found result for this query"
				];
        };
	}
	
	public function getDroneBySensorName($name)
	{
		try {
			$sensor = findByName($name);		
			return ['sucess' => true,
					'data' => $result->drone];	
		} catch (ModelNotFoundException $e) {
             return [
				'success' => false,
				'msg' => "No found result for this query"
				];
        };
	}
	
	public function getSensorValuesBySensorName($name)
	{
		try {
			return ['success' => true,
					'data' => $this->sensor->where('name', $name)->firstOrFail()->values];
		} catch (ModelNotFoundException $ex) {
			 return [
				'success' => false,
				'msg' => "No found result for this query"
				];
		}		
	}
	
	public function createSensor($array)
	{
		try {
			$drone = $this->drone->getDroneBy('name', $array['drone_name']);
			$requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());
			if ($requestArray['drone_id']){
				unset($requestArray['drone_id']);
			}
			$requestArray['drone_id'] = $drone->id;
			return ['success' => $drone->sensors()->save($requestArray)];
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "This drone was not found"
				];			
		}		
	}
	
	public function updateSensor($array, $name)
	{
		try {
			$sensor = findByName($name);
			$drone = $this->drone->getDroneBy('name', $array['drone_name']);
			$requestArray = $this->prepareToUpdate($array, $this->sensor->getFillable());
			if ($requestArray['drone_id']){
				unset($requestArray['drone_id']);
			}
			$requestArray['drone_id'] = $drone->id;
			$sensor->fill($requestArray);
            return ['success' => $sensor->save()];			
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "This sensor was not found"
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
				'msg' => "No found result for this query"
				];          
        }
	}

	private function findByName($name)
    {
        return $this->sensor->where('name', $name)->firstOrFail();
    }
}
