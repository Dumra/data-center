<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorValue extends Model
{
    protected $table = 'sensors_values';

    protected $fillable = ['value', 'sensor_id'];

    public function sensor()
    {
        return $this->belongsTo('App\Data\Models\Sensor');
    }
}
