<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mechanics extends Model
{
    use HasFactory;

    public function carowner()
    {
        return $this->hasOneThrough(owner::class,car::class,
        'mechanic_id', // Foreign key on the cars table...
        'car_id', // Foreign key on the owners table...
        'id', // Local key on the mechanics table...
        'id' // Local key on the cars table...
    );
    }

    public function car()
    {
        return $this->hasOne(car::class,'mechanic_id');
    }
}
