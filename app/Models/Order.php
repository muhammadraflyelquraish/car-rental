<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum OrderStatus: string
{
    case WAITING_FOR_PAYMENT = 'Waiting For Payment';
    case WAITING_FOR_PICKUP = 'Waiting for Pickup';
    case ON_GOING = 'On Going';
    case FINISHED = 'Finished';
    case CANCELED = 'Canceled';
}

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'car_id',
        'user_id',
        'pickup_location',
        'dropoff_location',
        'start_date',
        'end_date',
        'pickup_time',
        'order_status'
    ];

    protected $casts = [
        'order_status' => OrderStatus::class
    ];

    function car()
    {
        return $this->belongsTo(Car::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function payment()
    {
        return $this->hasOne(OrderPayment::class);
    }
}
