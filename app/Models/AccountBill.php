<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountBill extends Model
{
    protected $table = 'account_bills';
    protected $fillable = [
        'user_id',
        'account_id',
        'balance_before',
        'balance_after',
        'price',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(user::class);
    }

    public function GameAccount()
    {
        return $this->belongsTo(GameAccount::class, 'account_id');
    }
}
