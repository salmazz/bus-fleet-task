<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id'];

    public function trip_stations()
    {
        return $this->hasMany(TripStation::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
