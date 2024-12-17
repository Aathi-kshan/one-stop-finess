<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['coach_id', 'name', 'date', 'time', 'max_participants', 'location', 'price'];
    public function coach() {
        return $this->belongsTo(Coach::class, 'coach_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'classes_id');
    }
}
