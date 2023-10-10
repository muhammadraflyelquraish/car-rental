<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number_plate',
        'brand_id',
        'launch_year',
        'mileage',
        'transmission',
        'fuel_type',
        'number_of_seat',
        'price_per_day',
        'description'
    ];

    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    function accessories()
    {
        return $this->hasMany(CarAccessories::class);
    }

    function images()
    {
        return $this->hasMany(CarImage::class);
    }
}
