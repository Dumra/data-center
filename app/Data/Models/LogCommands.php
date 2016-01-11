<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
	use SoftDeletes;
	
    protected $table = 'log_commands';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'drone_id'];
	
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
