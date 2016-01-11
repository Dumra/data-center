<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensors';

    protected $fillable = ['name', 'drone_id'];

    public function drone()
    {
        return $this->belongsTo('App\Data\Models\Drone');
    }

    public function values()
    {
        return $this->hasMany('App\Data\Models\SensorValue');
    }
}
