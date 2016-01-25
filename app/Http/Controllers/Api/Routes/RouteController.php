<?php

namespace App\Http\Controllers\Api\Routes;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Routes\RouteRepositoryInterface;
use App\Http\Requests\Routes\UpdateRouteRequest;
use App\Http\Requests\Routes\CreateRouteRequest;
use Illuminate\Http\Request;

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

    public function getRouteByDate(Request $request, $id, $date, $dateEnd = null)
    {
        return $this->sendResponse($this->model->getRouteByDate($id, $date, $dateEnd), $request);
    }
}
