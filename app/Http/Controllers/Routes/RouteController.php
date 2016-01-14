<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Routes\RouteRepositoryInterface;
use App\Http\Requests\Routes\UpdateDroneRequest;
use App\Http\Requests\Routes\CreateRouteRequest;

class RouteController extends Controller
{
	//private $route;
	
	public function __construct(RouteRepositoryInterface $route)
	{
		$this->model = $route;
	}
	
	public function getRouteByDroneName($droneName = null)
	{
		return response($this->route->getRouteByDroneName($droneName));
	}
	
	public function addRoute(CreateRouteRequest $request)
	{
		return response($this->route->createRoute($request->all()));
	}
	
	public function updateRoute(UpdateDroneRequest $request, $id)
	{
		return response($this->route->updateRoute($request->all(), $id));
	}
	
	public function deleteRoute($id)
	{
		 return response($this->route->deleteRoute($id));
	}
	
	public function getRouteByDate($droneName, $date, $dateEnd = null)
	{
		return response($this->route->getRouteByDate($droneName, $date, $dateEnd));
	}
}
