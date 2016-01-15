<?php

namespace App\Http\Controllers\Api\Routes;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Routes\RouteRepositoryInterface;
use App\Http\Requests\Routes\UpdateRouteRequest;
use App\Http\Requests\Routes\CreateRouteRequest;

class RouteController extends AbstractApiController
{
    public function __construct(RouteRepositoryInterface $route)
    {
        $this->model = $route;
    }

    public function addRoute(CreateRouteRequest $request)
    {
        return $this->create($request);
    }

    public function updateRoute(UpdateRouteRequest $request, $id)
    {
        return $this->update($request, $id);
    }

    public function getRouteByDate($droneName, $date, $dateEnd = null)
    {
        return response($this->model->getRouteByDate($droneName, $date, $dateEnd));
    }
}
