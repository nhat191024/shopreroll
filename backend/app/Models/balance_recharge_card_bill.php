<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_recharge_card_bill extends Model
{
    protected $table = 'balance_recharge_card_bills';
    protected $fillable = [
        'user_id',
        'card_number',
        'card_serial',
        'mobil_carrier',
        'amount_fake',
        'amount_real',
        'balance_added',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(user::class);
    }
}
