<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AbstractApiController extends Controller
{
    protected $model;
    protected $token;

   /* public function __construct(Request $request)
    {
        $this->token = $request->headers->all();
    }*/

    protected function get(Request $request, $param = null )
    {
        $this->token = $request->headers->get('Authorization');
        return response(array_merge($this->model->get($param), ['token' =>   $this->token]));
    }

    protected function create($requestArray)
    {
        return response($this->model->create($requestArray->all()));
    }

    protected function update($requestArray, $param)
    {
        return response($this->model->update($param, $requestArray->all()));
    }

    protected function delete($param)
    {
        return response($this->model->delete($param));
    }
}
