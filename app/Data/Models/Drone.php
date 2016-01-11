<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    protected $table = 'drones';

    protected $fillable = ['name', 'status', 'type', 'available'];

    public function sensors()
    {
        return $this->hasMany('App\Data\Models\Sensor');
    }

    public function routes()
    {
        return $this->hasMany('App\Data\Models\Route');
    }

    public function commands()
    {
        return $this->hasMany('App\Data\Models\Command');
    }
}
