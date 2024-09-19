<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_hero extends Model
{
    protected $table = 'account_heroes';
    protected $fillable = [
        'account_id',
        'hero_id',
    ];
}
