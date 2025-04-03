<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceRechargeBankBill extends Model
{
    protected $table = 'balance_recharge_bank_bills';
    protected $fillable = [
        'user_id',
        'bank',
        'amount',
        'balance_added',
        'balance_before',
        'balance_after',
        'note',
        'status',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
