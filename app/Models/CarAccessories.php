<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAccessories extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'name',
        'is_featured'
    ];

    function car()
    {
        return $this->belongsTo(Car::class);
    }
}
