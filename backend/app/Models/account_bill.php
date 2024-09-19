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
}
