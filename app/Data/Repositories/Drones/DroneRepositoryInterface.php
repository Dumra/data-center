<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:22 PM
 */

namespace App\Data\Repositories\Drones;

interface DroneRepositoryInterface
{
    public function getDrone($name);
    public function updateDrone($name, $requestArray);
    public function destroyDrone($name);
    public function createDrone($array);
	public function getDroneBy($type, $value);
	public function getSensorsByDroneName($name);
	public function getRoutesByDroneName($name);
	public function getCommandsByDroneName($name);
}