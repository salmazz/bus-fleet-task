<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'trip_station_from_id', 'trip_station_to_id', 'user_id', 'seat_number'];

    public function trip_station_from()
    {
        return $this->belongsTo(TripStation::class, 'trip_station_from_id');
    }

    public function trip_station_to()
    {
        return $this->belongsTo(TripStation::class, 'trip_station_to_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
