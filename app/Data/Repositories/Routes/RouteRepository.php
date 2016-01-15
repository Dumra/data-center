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

    public function get($name)
    {
        if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->route->all()
            ];
        }
        try {
            $result = $this->drone->findByName($name)->routes;
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
            //return $dateInterval;
            $result = $this->drone->findByName($droneName)->routes()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one route with this drone by this date");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
    }

    public function create($array)
    {
        $drone = $this->drone->getBy('name', $array['drone_name']);
        $droneResult = $drone['data'];
        $requestArray = $this->prepareToUpdate($array, $this->route->getFillable());
        if (isset($requestArray['drone_id'])) {
            unset($requestArray['drone_id']);
        }
        $requestArray['drone_id'] = $droneResult->id;
        $droneCreated = $droneResult->routes()->save($this->route->create($requestArray));
        return [
            'success' => true,
            'data' => $droneCreated
        ];
    }

    public function update($id, $array)
    {
        try {
            $route = $this->findById($id);
            $drone = $this->drone->getBy('name', $array['drone_name']);
            $droneResult = $drone['data'];
            $requestArray = $this->prepareToUpdate($array, $this->route->getFillable());
            if (isset($requestArray['drone_id'])) {
                unset($requestArray['drone_id']);
            }
            $requestArray['drone_id'] = $droneResult->id;
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
        return $this->route->where('id', $id)->firstOrFail();
    }

}
