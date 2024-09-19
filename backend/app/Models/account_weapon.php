<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_weapon extends Model
{
    protected $table = 'account_weapons';
    protected $fillable = [
        'account_id',
        'weapon_id',
    ];
}
