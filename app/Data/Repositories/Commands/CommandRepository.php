<?php

namespace App\Data\Repositories\Commands;

use App\Data\Models\Command;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Data\Repositories\Drones\DroneRepositoryInterface;

class CommandRepository extends AbstractRepository implements CommandRepositoryInterface
{
	private $command;
	private $drone;
	
	public function __construct(Command $command, DroneRepositoryInterface $drone)
	{
		$this->command = $command;
		$this->drone = $drone;
	}

	public function get($name)
	{
		 if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->command->all()
            ];
        }
        try {           
            $result = $this->drone->findByName($name)->commands;
			return $this->checkResult($result, "No one command with this drone");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
	}
	
	public function getCommandByDate($droneName, $date, $dateEnd)
	{
		try {
			$dateInterval = $this->getDateRange($date, $dateEnd);
            $result = $this->drone->findByName($droneName)->commands()->whereBetween('added', $dateInterval)->get();
			return $this->checkResult($result, "No one command with this drone by this date");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this name does not exist'
            ];
        }
	}
	
	public function create($array)
	{
		$drone = $this->drone->getBy('name', $array['drone_name']);
        $droneResult = $drone['data'];
        $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
        if (isset($requestArray['drone_id'])) {
            unset($requestArray['drone_id']);
        }
        $requestArray['drone_id'] = $droneResult->id;
        $droneCreated = $droneResult->commands()->save($this->command->create($requestArray));
        return ['success' => true,
                'data' => $droneCreated];
	}
	
	public function update($id, $array)
	{
		try {
            $command = $this->findById($id);
            $drone = $this->drone->getBy('name', $array['drone_name']);
            $droneResult = $drone['data'];
            $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
            if (isset($requestArray['drone_id'])) {
                unset($requestArray['drone_id']);
            }
            $requestArray['drone_id'] = $droneResult->id;
			$command->fill($requestArray);
            return ['success' => $command->save(),
                    'data' => $command];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This command does not exit"
            ];
        }
	}
	
	public function delete($id)
	{
		 try {
            $route = $this->findById($id);
            return ['success' => $route->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "This command does not exit"
            ];
        }
	}

	private function findById($id)
	{
		return $this->command->where('id', $id)->firstOrFail();
	}

}
