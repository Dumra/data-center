<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Command extends Model
{
	use SoftDeletes;
	
    protected $table = 'tasks';

    protected $fillable = ['description',  'status', 'added', 'drone_id'];
	
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
	
	 public function values()
    {
        return $this->hasMany('App\Data\Models\TaskValue', 'task_id');
    }
}
