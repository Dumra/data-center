<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 11:19 PM
 */

namespace App\Data\Repositories\SensorValues;

use App\Data\Repositories\AbstractCrudInterface;

interface SensorValueRepositoryInterface extends AbstractCrudInterface
{
    public function getByDate($droneName, $date, $dateEnd);
}