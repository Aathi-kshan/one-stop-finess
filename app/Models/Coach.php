<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    

    protected $fillable = [

        'user_id',

        'specialization',

        'bio',

        'experience',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class() {
        return $this->hasMany(Classes::class, 'coach_id');
    }
}

