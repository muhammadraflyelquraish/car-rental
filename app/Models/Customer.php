<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum StatusApproval: string
{
    case ON_PROCCESS = 'On Procces';
    case REJECTED = 'Rejected';
    case APPROVED = 'Approved';

    public static function getStringValue(StatusApproval $status): string
    {
        return match ($status) {
            self::ON_PROCCESS => 'On Procces',
            self::REJECTED => 'Rejected',
            self::APPROVED => 'Approved',
        };
    }
}

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'ktp_image',
        'sim_image',
        'status_approval',
        'note'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
