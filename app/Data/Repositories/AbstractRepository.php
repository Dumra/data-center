<?php

namespace App\Data\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class AbstractRepository
{
	protected function checkResult($result)
	{
		try {
			if ($result){
				return [
					'success' => true,
					'data' => $result
					];
			}
			throw new ModelNotFoundException();
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => "No found result for this query"];
		}
	}
	
	protected function prepareToUpdate($array, $fillableArray)
    {
        $resultArray = [];        
        foreach ($fillableArray as $value) {
            if (array_key_exists($value, $array)) {
                $resultArray[$value] = $array[$value];
            }
        }
        return $resultArray;
    }
}
