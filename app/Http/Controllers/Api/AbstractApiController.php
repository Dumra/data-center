<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AbstractApiController extends Controller
{
    protected $model; 

    protected function get(Request $request, $param = null )
    {       
        return $this->sendResponse($this->model->get($param), $request);
    }

    protected function create($requestArray)
    {
        return $this->sendResponse($this->model->create($requestArray->all()), $requestArray);
    }

    protected function update($requestArray, $param)
    {
        return $this->sendResponse($this->model->update($param, $requestArray->all()), $requestArray);
    }

    protected function delete(Request $request, $param)
    {
        return $this->sendResponse($this->model->delete($param), $request);
    }
	
	protected function getTokenFromHeader($request)
	{
		return $request->headers->get('Authorization');
	}
	
	protected function sendResponse($result, $request)
	{
		return response(array_merge($result, ['token' => $this->getTokenFromHeader($request)]));
	}
}
