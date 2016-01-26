<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/10/2016
 * Time: 11:20 PM
 */

namespace App\Data\Repositories\Drones;

use App\Data\Models\Drone;
use App\Data\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DroneRepository extends AbstractRepository implements DroneRepositoryInterface
{
    private $drone;

    public function __construct(Drone $drone)
    {
        $this->drone = $drone;
    }

    public function get($id)
    {
        // TODO: Implement getDrone() method.
        if (is_null($id)) {
            return [
                'success' => true,
                'data' => $this->drone->all()
            ];
        }
        try {
            return [
                'success' => true,
                'data' => $this->findById($id)
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => 'Drone with this id does not exist'
            ];
        }
    }

    public function delete($id)
    {
        // TODO: Implement destroyDrone() method.
        try {
            $drone = $this->findById($id);
            return ['success' => $drone->delete()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "Drone with this id does not exist"
            ];
        }
    }

    public function update($id, $requestArray)
    {
        try {
            $drone = $this->findById($id);
            $requestArray = $this->prepareToUpdate($requestArray, $this->drone->getFillable());
            $drone->fill($requestArray);
            return ['success' => $drone->save()];
        } catch (ModelNotFoundException $e) {
            return [
                'success' => false,
                'msg' => "Drone with this id does not exist"
            ];
        }
    }

    public function create($requestArray)
    {
        $requestArray = $this->prepareToUpdate($requestArray, $this->drone->getFillable());
        $drone = $this->drone->create($requestArray);
        return [
            'success' => true,
            'data' => $drone
        ];
    }

    public function getBy($field, $value)
    {
        $result = $this->findBy($field, $value);
        return $this->checkResult($result, "Drone where $field = $value does not exist");
    }

    public function getDependences($id, $dependence)
    {
        // TODO: Implement getDependences() method.
        try {
            $result = $this->findById($id)->$dependence;
            return $this->checkResult($result, "Not one $dependence one this drone");
        } catch (ModelNotFoundException $ex) {
            return [
                'success' => false,
                'msg' => "Drone with this id does not exit"
            ];
        }
    }

    private function findBy($field, $value)
    {
        if ($field === 'name') {
            return $this->findByName($value);
        }
        return $this->drone->where($field, $value)->get();
    }

    private function findByName($name)
    {
        return $this->drone->where('name', $name)->firstOrFail();
    }
	
	public function findById($id)
    {
        return $this->drone->findOrFail($id);
    }

}