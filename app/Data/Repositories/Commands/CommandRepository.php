<?php

namespace App\Data\Repositories\Commands;

use App\Data\Models\Command;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Data\Repositories\Drones\DroneRepositoryInterface;
use App\Utilities\DateUtility;

class CommandRepository extends AbstractRepository implements CommandRepositoryInterface
{
    private $command;
    private $drone;

    public function __construct(Command $command, DroneRepositoryInterface $drone)
    {
        $this->command = $command;
        $this->drone = $drone;
    }

    public function get($id)
    {
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->command->all()
            ];
        }
        try {
            $drone = $this->drone->get($id);
            $result = $drone['data']->commands;
            return $this->checkResult($result, "No one command with this drone");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this id does not exist'
            ];
        }
    }

    public function getCommandByDate($droneId, $date, $dateEnd)
    {
        try {
            $dateInterval = $this->getDateRange($date, $dateEnd);
            $drone = $this->drone->findById($droneId);
            $result = $drone->commands()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one command with this drone by this date");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this id does not exist'
            ];
        }
    }

    public function create($array)
    {
        $drone = $this->drone->get($array['drone_id']);
        $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
        $requestArray['added'] = DateUtility::formatDate($requestArray['added']);
        $droneCreated = $drone['data']->commands()->save($this->command->create($requestArray));
        return [
            'success' => true,
            'data' => $droneCreated
        ];
    }

    public function update($id, $array)
    {
        try {
            $command = $this->findById($id);
            $requestArray = $this->prepareToUpdate($array, $this->command->getFillable());
            $requestArray['added'] = DateUtility::formatDate($requestArray['added']);
            $command->fill($requestArray);
            return [
                'success' => $command->save(),
                'data' => $command
            ];
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
        return $this->command->findOrFail($id);
    }

}
