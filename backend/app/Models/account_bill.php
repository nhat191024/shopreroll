<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_bill extends Model
{
    protected $table = 'account_bills';
    protected $fillable = [
        'user_id',
        'account_id',
        'price',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(user::class);
    }

    public function GameAccount()
    {
        return $this->belongsTo(game_account::class);
    }
}
