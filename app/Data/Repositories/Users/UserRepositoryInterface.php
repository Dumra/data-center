<?php

namespace App\Data\Repositories\Users;

use App\Data\Repositories\AbstractCrudInterface;

interface UserRepositoryInterface extends AbstractCrudInterface
{
    public function getCredsForMailing();

    public function encryptPasses();
}
