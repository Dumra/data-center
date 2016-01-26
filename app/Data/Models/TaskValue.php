<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

namespace App\Data\Models;

class TaskValue extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */	
	protected $touches = ['command'];
	
    protected $dates = ['deleted_at'];
	
    protected $table = 'task_values';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'task_id'];

    public function task()
    {
        return $this->belongsTo('App\Data\Models\Command');
    }
}
