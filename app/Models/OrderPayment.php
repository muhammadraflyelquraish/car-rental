<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum PaymentStatus: string
{
    case ON_PROCESS = 'On Procces';
    case EXPIRED = 'Expired';
    case PAID = 'Paid';
    case FAILED = 'Failed';
}

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method_id',
        'price',
        'quantity',
        'grand_total',
        'payment_ref',
        'payment_status',
        'note'
    ];

    function order()
    {
        return $this->belongsTo(Order::class);
    }

    function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    function actions()
    {
        return $this->hasMany(OrderPaymentAction::class);
    }
}
