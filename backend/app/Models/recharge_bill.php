<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recharge_bill extends Model
{
    protected $table = 'recharge_bills';
    protected $fillable = [
        'user_id',
        'recharge_package_id',
        'UID',
        'username',
        'password',
        'server',
        'character_name',
        'phone',
        'note',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(user::class);
    }

    public function RechargePackage()
    {
        return $this->belongsTo(recharge_package::class);
    }
}
