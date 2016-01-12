<?php

namespace App\Data\Repositories\Routes;

use App\Data\Models\Commands;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Utilities\DateUtility;

class RouteRepository extends AbstractRepository implements RouteRepositoryInterface
{
	private $command;
	private $drone;
	
	public function __construct(Commands $command, DroneRepositoryInterface $drone)
	{
		$this->command = $command;
		$this->drone = $drone;
	}

	public function getRouteByDroneName($name)
	{
		 if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->command->all()
            ];
        }
        try {           
            $result = $this->drone->findByName($name)->command;           
			return $this->checkResult($result, "No one route with this drone");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
	}
	
	public function getRouteByDate($droneName, $date, $dateEnd)
	{
		try {     
			$dateInterval = $this->getDateRange($date, $dateEnd);
            $result = $this->drone->findByName($droneName)->commands()->whereBetween('added', $dateInterval);           
			return $this->checkResult($result, "No one route with this drone by this date");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
	}
	
	public function createRoute($array)
	{
		$drone = $this->drone->getDroneBy('name', $array['drone_name']);
        $droneResult = $drone['data'];
        $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
        if (isset($requestArray['drone_id'])) {
            unset($requestArray['drone_id']);
        }
        $requestArray['drone_id'] = $droneResult->id;
		$requestArray['added'] = strtotime($requestArray['added']);
        $droneCreated = $droneResult->sensors()->save($this->command->create($requestArray));
        return ['success' => true,
                'data' => $droneCreated];
	}
	
	public function updateRoute($array, $id)
	{
		try {
            $route = $this->findById($id);
            $drone = $this->drone->getDroneBy('name', $array['drone_name']);
            $droneResult = $drone['data'];
            $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
            if (isset($requestArray['drone_id'])) {
                unset($requestArray['drone_id']);
            }
            $requestArray['drone_id'] = $droneResult->id;
            $route->fill($requestArray);
            return ['success' => $route->save(),
                    'data' => $route];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This route does not exit"
            ];
        }
	}
	
	public function deleteRoute($id)
	{
		 try {
            $route = $this->findById($id);
            return ['success' => $route->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "This route does not exit"
            ];
        }
	}

	private function findById($id)
	{
		$this->route->firstOrFail($id);
	}
	
	private function getDateRange($date, $dateEnd)
	{
		if (is_null($dateEnd))
		{
			return DateUtility::getDateRange($date);
		}
		$start = DateUtility::getDateRange($date);
		$end = DateUtility::getDateRange($dateEnd);
		return [$start[0], $end[0]];
	}

}
