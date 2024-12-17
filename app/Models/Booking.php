<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'classes_id'];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Class() {
        return $this->belongsTo(Classes::class,'classes_id');
    }
}
