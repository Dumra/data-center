<?php

namespace App\Data\Repositories\Commands;

interface CommandRepositoryInterface
{
	public function getCommandByDroneName($name);
	public function getCommandeByDate($droneName, $date, $dateEnd);
	public function createCommand($array);
	public function updateCommand($array, $id);
	public function deleteCommand($id);
}
