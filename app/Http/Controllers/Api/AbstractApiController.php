<?php

use App\Http\Controllers;

abstract class AbstractApiController extends Controllers
{
	protected $model;
	
	protected function get($param)
	{
		return response($this->model->get($param));
	}
	
	protected function create($requestArray)
	{
		return response($this->model->create($requestArray->all()));
	}
	
	protected function update($requestArray, $param)
	{
		return response($this->model->update($requestArray->all(), $param));
	}
	
	protected function delete($param)
	{
		return response($this->model->delete($param));
	}
}
