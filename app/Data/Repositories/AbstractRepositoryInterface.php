<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 1:07 AM
 */

namespace App\Data\Repositories;


interface AbstractRepositoryInterface
{
    public function get($name);

    public function update($name, $requestArray);

    public function delete($name);

    public function create($array);
}