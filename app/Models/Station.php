<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function trip_stations()
    {
        return $this->hasMany(TripStation::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_stations');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings');
    }
}
