<?php

namespace App\Data\Repositories\Routes;

use App\Data\Models\Route;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Utilities\DateUtility;

class RouteRepository extends AbstractRepository implements RouteRepositoryInterface
{
    private $route;
    private $drone;

    public function __construct(Route $route, DroneRepositoryInterface $drone)
    {
        $this->route = $route;
        $this->drone = $drone;
    }

    public function get($id)
    {
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->route->all()
            ];
        }
        try {
            $drone = $this->drone->findById($id);
			$result = $drone->routes;
            return $this->checkResult($result, "No one route with this drone");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this id does not exist'
            ];
        }
    }

    public function getRouteByDate($droneId, $date, $dateEnd)
    {
        try {
            $dateInterval = $this->getDateRange($date, $dateEnd);
            //return $dateInterval;
			$droneResult = $this->drone->findById($droneId);
            $result = $droneResult->routes()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one route with this drone by this date");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this id does not exist'
            ];
        }
    }

    public function create($array)
    {
		$drone = $this->drone->get($array['drone_id']);
        $requestArray = $this->prepareToUpdate($array, $this->route->getFillable());
        $requestArray['added'] = DateUtility::formatDate($array['added']);
        $droneCreated = $drone['data']->routes()->save($this->route->create($requestArray));
		$drone['data']->fill($this->prepareForDroneArray($array));
		$drone['data']->save();
        return [
            'success' => true,
            'data' => $droneCreated
        ];
    }

    public function update($id, $array)
    {
        try {
            $route = $this->findById($id);           
            $requestArray = $this->prepareToUpdate($array, $this->route->getFillable());
            $requestArray['added'] = DateUtility::formatDate($requestArray['added']);
            $route->fill($requestArray);
			$routeSave = $route->save();
			$droneId = $route->drone_id;
			$drone = $this->drone->get($droneId); 
			$drone['data']->fill($this->prepareForDroneArray($array));
			$drone['data']->save();
            return [
                'success' => $routeSave,
                'data' => $route
            ];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This route does not exit"
            ];
        }
    }

    public function delete($id)
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
        return $this->route->findOrFail($id);
    }
	
	private function prepareForDroneArray($requestArray)
	{
		$fields = ['latitude', 'longitude', 'battery'];
		$resultArray = [];
		foreach ($requestArray as $key => $value) {
			if (in_array($key, $fields)) {
				$resultArray[$key] = $value;
			}
		}
		
		return $requestArray;
	}

}
