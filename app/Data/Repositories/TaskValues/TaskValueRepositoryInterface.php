<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 11:19 PM
 */

namespace App\Data\Repositories\TaskValues;

use App\Data\Repositories\AbstractCrudInterface;

interface TaskValueRepositoryInterface extends AbstractCrudInterface
{
    public function getByDate($staskId, $date, $dateEnd);
}