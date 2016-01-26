<?php

namespace App\Http\Controllers\Api\Commands;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\Commands\CommandRepositoryInterface;
use App\Http\Requests\Commands\UpdateCommandRequest;
use App\Http\Requests\Commands\CreateCommandRequest;
use Illuminate\Http\Request;

class CommandController extends AbstractApiController
{
	public function __construct(CommandRepositoryInterface $command)
	{
		$this->model = $command;
	}
	
	public function addCommand(CreateCommandRequest $request)
	{
		return $this->create($request);
	}
	
	public function updateCommand(UpdateCommandRequest $request, $id)
	{
		return $this->update($request, $id);
	}
	
	public function getCommandByDate($droneId, $date, $dateEnd = null)
	{
		return response($this->model->getCommandByDate($droneId, $date, $dateEnd));
	}	

    public function getTaskValuesByTaskId(Request $request, $id)
    {
        return $this->sendResponse($this->model->getTaskValuesByTaskId($id), $request);
    }
}
