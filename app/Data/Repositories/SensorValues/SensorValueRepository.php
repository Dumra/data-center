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

class SensorValueRepository extends AbstractRepository implements SensorValueRepositoryInterface
{
    private $sensorValues;
    private $sensor;

    public function __construct(SensorValue $sensorValue, SensorRepositoryInterface $sensor)
    {
        $this->sensorValues = $sensorValue;
        $this->sensor = $sensor;
    }

    public function get($name)
    {
        if (is_null($name)) {
            return [
                'success' => true,
                'data' => $this->sensorValues->all()
            ];
        }
        try {
            $result = $this->sensor->findByName($name)->values;
            return $this->checkResult($result, "No one value with this sensor");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Sensor with this name does not exist'
            ];
        }
    }

    public function getByDate($sensorName, $date, $dateEnd)
    {
        try {
            $dateInterval = $this->getDateRange($date, $dateEnd);
            $resultSensor =  $this->sensor->get($sensorName);
            $result = $resultSensor['data']->values()->whereBetween('added', $dateInterval)->get();
            return $this->checkResult($result, "No one values with this drone by this sensor");
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Sensor with this name does not exist'
            ];
        }
    }

    public function create($array)
    {
        $drone = $this->sensor->get($array['sensor_name']);
        $droneResult = $drone['data'];
        $requestArray = $this->prepareToUpdate($array, $this->sensorValues->getFillable());
        if (isset($requestArray['sensor_id'])) {
            unset($requestArray['sensor_id']);
        }
        $requestArray['sensor_id'] = $droneResult->id;
        $droneCreated = $droneResult->values()->save($this->sensorValues->create($requestArray));
        return ['success' => true,
            'data' => $droneCreated];
    }

    public function update($id, $array)
    {
        try {
            $command = $this->findById($id);
            $drone = $this->sensor->get($array['sensor_name']);
            $droneResult = $drone['data'];
            $requestArray = $this->prepareToUpdate($array, $this->sensorValues->getFillable());
            if (isset($requestArray['sensor_id'])) {
                unset($requestArray['sensor_id']);
            }
            $requestArray['sensor_id'] = $droneResult->id;
            $command->fill($requestArray);
            return ['success' => $command->save(),
                'data' => $command];
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
        return $this->sensorValues->where('id', $id)->firstOrFail();
    }

}