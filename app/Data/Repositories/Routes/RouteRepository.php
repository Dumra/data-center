<?php

namespace App\Data\Repositories\Routes;

use App\Data\Models\Route;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Data\Repositories\Drones\DroneRepositoryInterface;

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
            $drone = $this->drone->get($id);
			$result = $drone['data']->routes;
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
			$droneResult = $this->drone->get($droneId);
            $result = $droneResult['data']->findById($droneId)->routes()->whereBetween('added', $dateInterval)->get();
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
        $droneCreated = $drone['data']->routes()->save($this->route->create($requestArray));
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
            $route->fill($requestArray);
            return [
                'success' => $route->save(),
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

}
