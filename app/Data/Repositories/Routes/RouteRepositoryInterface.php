<?php

namespace App\Data\Repositories\Routes;

interface RouteRepositoryInterface
{
	public function getRouteByDroneName($name);
	public function getRouteByDate($droneName, $date, $dateEnd);
	public function createRoute($array);
	public function updateRoute($array, $id);
	public function deleteRoute($id);
}
