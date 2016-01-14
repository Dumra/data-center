<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:22 PM
 */

namespace App\Data\Repositories\Drones;

use App\Data\Repositories\AbstractRepositoryInterface;

interface DroneRepositoryInterface extends AbstractRepositoryInterface
{
    public function getBy($type, $value);

    public function getDependences($droneName, $dependence);
}