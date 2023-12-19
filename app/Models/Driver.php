<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum DriverStatus: string
{
    case ACTIVE = 'Active';
    case NONACTIVE = 'Nonactive';

    public static function getStringValue(DriverStatus $status): string
    {
        return match ($status) {
            self::ACTIVE => 'Active',
            self::NONACTIVE => 'Nonactive',
        };
    }
}

class Driver extends Model
{
    protected $fillable = [
        "name",
        "phone_number",
        "address",
        "ktp_image",
        "sim_image",
        "status"
    ];

    use HasFactory;
}
