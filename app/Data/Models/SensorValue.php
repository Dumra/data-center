<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SensorValue extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */	
	protected $touches = ['sensor'];
	
    protected $dates = ['deleted_at'];
	
    protected $table = 'sensors_values';

    protected $fillable = ['value', 'sensor_id'];

    public function sensor()
    {
        return $this->belongsTo('App\Data\Models\Sensor');
    }
}
