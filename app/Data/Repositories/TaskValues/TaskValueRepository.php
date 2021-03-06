<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 11:17 PM
 */

namespace App\Data\Repositories\TaskValues;

use App\Data\Models\TaskValue;
use App\Data\Repositories\AbstractRepository;
use App\Data\Repositories\Commands\CommandRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Utilities\DateUtility;

class TaskValueRepository extends AbstractRepository implements TaskValueRepositoryInterface
{
    private $taskValues;
    private $command;

    public function __construct(TaskValue $sensorValue, CommandRepositoryInterface $command)
    {
        $this->taskValues = $sensorValue;
        $this->command = $command;
    }

    public function get($id)
    {
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->taskValues->all()
            ];
        }
        try {
			$resultTask =  $this->command->findById($id);
            $result = $resultTask->values;
            return $this->checkResult($result, "No one value with this task");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Task with this id does not exist'
            ];
        }
    }

    /*public function getByDate($taskId, $date, $dateEnd)
    {
        try {
            $dateInterval = $this->getDateRange($date, $dateEnd);
            $resultTask =  $this->command->findById($taskId);
            $result = $resultTask->values()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one values with this task");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Task with this id does not exist'
            ];
        }
    }*/

    public function create($array)
    {
        $sensor = $this->command->findById($array['task_id']);
        $requestArray = $this->prepareToUpdate($array, $this->taskValues->getFillable());
        $valueCreated = $sensor->values()->create($array);
        return ['success' => true,
            'data' => $valueCreated];
    }

    public function update($id, $array)
    {
        try {
            $value = $this->findById($id);           
            $requestArray = $this->prepareToUpdate($array, $this->taskValues->getFillable());
            $value->fill($requestArray);
            return ['success' => $value->save(),
					'data' => $value];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This task_value does not exit"
            ];
        }
    }

    public function delete($id)
    {
        try {
            $value = $this->findById($id);
            return ['success' => $value->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "This value does not exit"
            ];
        }
    }

    private function findById($id)
    {
        return $this->taskValues->findOrFail($id);
    }

}