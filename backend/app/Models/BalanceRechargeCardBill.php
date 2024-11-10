<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceRechargeCardBill extends Model
{
    protected $table = 'balance_recharge_card_bills';
    protected $fillable = [
        'user_id',
        'number',
        'serial',
        'mobile_carrier',
        'amount_fake',
        'amount_real',
        'balance_added',
        'status',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
