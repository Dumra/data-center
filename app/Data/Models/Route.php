<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';

    protected $fillable = ['latitude', 'longitude', 'height', 'direction', 'battery', 'drone_id'];

    public function drone()
    {
        return $this->belongsTo('App\Data\Models\Drone');
    }
}
