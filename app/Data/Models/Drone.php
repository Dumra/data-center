<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drone extends Model
{
	use SoftDeletes;
	
    protected $table = 'drones';

    protected $fillable = ['name', 'status', 'type', 'available'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
