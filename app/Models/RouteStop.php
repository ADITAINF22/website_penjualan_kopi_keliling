<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    protected $fillable = [
        'place_name',
        'address',
        'day',
        'start_time',
        'end_time',
        'latitude',
        'longitude'
    ];
}
