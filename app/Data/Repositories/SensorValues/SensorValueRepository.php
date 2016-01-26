<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 11:17 PM
 */

namespace App\Data\Repositories\SensorValues;

use App\Data\Models\SensorValue;
use App\Data\Repositories\AbstractRepository;
use App\Data\Repositories\Sensors\SensorRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Utilities\DateUtility;

class SensorValueRepository extends AbstractRepository implements SensorValueRepositoryInterface
{
    private $sensorValues;
    private $sensor;

    public function __construct(SensorValue $sensorValue, SensorRepositoryInterface $sensor)
    {
        $this->sensorValues = $sensorValue;
        $this->sensor = $sensor;
    }

    public function get($id)
    {
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->sensorValues->all()
            ];
        }
        try {
			$resultSensor =  $this->sensor->get($id);
            $result = $resultSensor['data']->values;
            return $this->checkResult($result, "No one value with this sensor");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Sensor with this id does not exist'
            ];
        }
    }

    public function getByDate($sensorId, $date, $dateEnd)
    {
        try {
            $dateInterval = $this->getDateRange($date, $dateEnd);
            $resultSensor =  $this->sensor->findById($sensorId);
            $result = $resultSensor->values()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one values with this drone by this sensor");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Sensor with this id does not exist'
            ];
        }
    }

    public function create($array)
    {
        $sensor = $this->sensor->get($array['sensor_id']);
        $sensorResult = $sensor['data'];
        $requestArray = $this->prepareToUpdate($array, $this->sensorValues->getFillable());
        $requestArray['added'] = DateUtility::formatDate($requestArray['added']);
        $valueCreated = $sensorResult->values()->save($this->sensorValues->create($requestArray));
        return ['success' => true,
            'data' => $valueCreated];
    }

    public function update($id, $array)
    {
        try {
            $value = $this->findById($id);           
            $requestArray = $this->prepareToUpdate($array, $this->sensorValues->getFillable());
            $requestArray['added'] = DateUtility::formatDate($requestArray['added']);
            $value->fill($requestArray);
            return ['success' => $value->save(),
                'data' => $value];
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "This sensor_value does not exit"
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
                'msg' => "This value does not exit"
            ];
        }
    }

    private function findById($id)
    {
        return $this->sensorValues->findOrFail($id);
    }

}