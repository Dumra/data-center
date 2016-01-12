<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $touches = ['drone'];
	
    protected $dates = ['deleted_at'];
	
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
