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
				'msg' => 'No found result for this query'
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
				'msg' => "No found result for this query"
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
				'msg' => "No found result for this query"
				];
        }
    }

    public function createDrone($requestArray)
    {
        $requestArray = $this->prepareToUpdate($requestArray, $this->drone->getFillable());
        $drone = new Drone();
        $drone->fill($requestArray);
        return ['success' => $drone->save()];         
    }
	
	public function getDroneBy($field, $value)
	{
		$result = $this->findBy($field, $value);
		return $this->checkResult($result);
	}
	
	public function getSensorsByDroneName($name)
	{
		try {
			return  ['success' => true,
					'data' => $this->drone->where('name', $name)->firstOrFail()->sensors];
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "No found result for this query"
				];
		}		
	}
	
	public function getRoutesByDroneName($name)
	{
		try {
			return  ['success' => true,
					'data' => $this->drone->where('name', $name)->firstOrFail()->routes];
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "No found result for this query"
				];
		}		
	}
	
	public function getCommandsByDroneName($name)
	{
		try {
			return  ['success' => true,
					'data' => $this->drone->where('name', $name)->firstOrFail()->commands];
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "No found result for this query"
				];
		}		
	}
	
	private function findBy($field, $value)
	{
		if ($field === 'name')
		{
			return $this->drone->where($field, $value)->firstOrFail();
		}
		return $this->drone->where($field, $value)->get();
	}

    private function findByName($name)
    {
        return $this->drone->where('name', $name)->firstOrFail();
    }
   
}