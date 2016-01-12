<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Commands\CommandRepository;
use App\Http\Requests\Commads\UpdateCommandRequest;
use App\Http\Requests\Commads\CreateCommandRequest;

class CommandController extends Controller
{
	private $command;
	
	public function __construct(CommandRepository $command)
	{
		$this->command = $command;
	}
	
	public function getCommandByDroneName($droneName = null)
	{
		return response($this->command->getCommandByDroneName($droneName));
	}
	
	public function addCommand(CreateCommandRequest $request)
	{
		return response($this->command->createCommand($request->all()));
	}
	
	public function updateCommand(UpdateCommandRequest $request, $id)
	{
		return response($this->command->updateCommand($request->all(), $id));
	}
	
	public function deleteCommand($id)
	{
		 return response($this->command->deleteCommand($id));
	}
	
	public function getCommandByDate($droneName, $date, $dateEnd = null)
	{
		return response($this->command->getCommandByDate($droneName, $date, $dateEnd));
	}
}
