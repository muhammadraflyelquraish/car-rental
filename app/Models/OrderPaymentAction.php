<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_payment_id',
        'name',
        'method',
        'url'
    ];
}
