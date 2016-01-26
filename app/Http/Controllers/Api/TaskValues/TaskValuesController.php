<?php

namespace App\Http\Controllers\Api\SensorValues;

use App\Http\Controllers\Api\AbstractApiController;
use App\Data\Repositories\TaskValues\TaskValueRepositoryInterface;
use App\Http\Requests\TaskValues\TaskValuesCreateRequest;
use App\Http\Requests\TaskValues\TaskValuesUpdateRequest;
use Illuminate\Http\Request;

class TaskValuesController extends AbstractApiController
{
	public function __construct(TaskValueRepositoryInterface $taskVal)
    {
        $this->model = $taskVal;
    }

    public function getValueByDate(Request $request, $taskId, $date, $dateEnd = null)
    {
        return $this->sendResponse($this->model->getByDate($taskId, $date, $dateEnd), $request);
    }

    public function createValue(TaskValuesCreateRequest $request)
    {
        return $this->create($request);
    }

    public function updateValue(TaskValuesUpdateRequest $request, $id)
    {
        return $this->update($request, $id);
    }
}
