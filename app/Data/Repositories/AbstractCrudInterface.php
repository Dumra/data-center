<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/14/2016
 * Time: 1:07 AM
 */

namespace App\Data\Repositories;


interface AbstractCrudInterface
{
    public function get($id);

    public function update($id, $requestArray);

    public function delete($id);

    public function create($array);
}