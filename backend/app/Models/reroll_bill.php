<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reroll_bill extends Model
{
    protected $table = 'reroll_bills';
    protected $fillable = [
        'user_id',
        'reroll_package_id',
        'reroll_key_id',
        'price',
        'status',
    ];
}
