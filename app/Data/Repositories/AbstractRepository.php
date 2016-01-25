<?php

namespace App\Data\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Utilities\DateUtility;

abstract class AbstractRepository
{
	protected function checkResult($result, $errorMsg)
	{
		try {
			if (!empty($result->toArray())){
				return [
					'success' => true,
					'data' => $result
					];
			}
			throw new ModelNotFoundException();
		} catch (ModelNotFoundException $ex) {
			return [
				'success' => false,
				'msg' => $errorMsg];
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

	protected function getDateRange($date, $dateEnd)
	{
		if (is_null($dateEnd))
		{
			return DateUtility::getRange($date);
		}
		$start = DateUtility::getRange($date);
		$end = DateUtility::getRange($dateEnd);
		return [$start[0], $end[0]];
	}
}
