<?php

namespace App\Data\Repositories\Commands;

use App\Data\Repositories\AbstractCrudInterface;

interface CommandRepositoryInterface extends AbstractCrudInterface
{
    public function getCommandByDate($droneName, $date, $dateEnd);

}
