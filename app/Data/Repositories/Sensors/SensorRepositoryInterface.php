<?php

namespace App\Data\Repositories\Sensors;

interface SensorRepositoryInterface
{
	public function getSensor($name);
	public function getDroneBySensorName($name);
	public function getSensorValuesBySensorName($name);
	public function createSensor($array);
	public function updateSensor($array, $name);
	public function deleteSensor($name);
}
