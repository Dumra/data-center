<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskValue extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */	
	protected $touches = ['task'];
	
    protected $dates = ['deleted_at'];
	
    protected $table = 'task_values';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'task_id'];

    public function task()
    {
        return $this->belongsTo('App\Data\Models\Command', 'task_id');
    }
}
