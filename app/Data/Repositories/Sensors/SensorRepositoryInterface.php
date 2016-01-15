<?php

namespace App\Data\Repositories\Sensors;

use App\Data\Repositories\AbstractCrudInterface;

interface SensorRepositoryInterface extends AbstractCrudInterface
{
    public function getDroneBySensorName($name);

    public function getSensorValuesBySensorName($name);

}
