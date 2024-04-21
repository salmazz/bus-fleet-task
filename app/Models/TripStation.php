<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripStation extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'station_id', 'departure_time', 'order'];
}
