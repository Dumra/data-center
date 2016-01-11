<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $table = 'log_commands';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'drone_id'];

    public function drone()
    {
        return $this->belongsTo('App\Data\Models\Drone');
    }
}
