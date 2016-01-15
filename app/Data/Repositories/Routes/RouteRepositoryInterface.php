<?php

namespace App\Data\Repositories\Routes;

use App\Data\Repositories\AbstractCrudInterface;

interface RouteRepositoryInterface extends AbstractCrudInterface
{
    public function getRouteByDate($droneName, $date, $dateEnd);

}
