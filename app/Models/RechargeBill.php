<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargeBill extends Model
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
        'balance_before',
        'balance_after',
        'note',
        'status',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function RechargePackage()
    {
        return $this->belongsTo(RechargePackage::class);
    }
}
