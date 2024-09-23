<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_recharge_bank_bill extends Model
{
    protected $table = 'balance_recharge_bank_bills';
    protected $fillable = [
        'user_id',
        'bank',
        'amount',
        'balance_before',
        'balance_after',
        'note',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(user::class);
    }
}
