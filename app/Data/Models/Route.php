<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
	use SoftDeletes;
	
    protected $table = 'routes';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'battery', 'drone_id'];
	
	protected $touches = ['drone'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function drone()
    {
        return $this->belongsTo('App\Data\Models\Drone');
    }
}
