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

    public function Account()
    {
        return $this->belongsTo(game_account::class);
    }

    public function Hero()
    {
        return $this->belongsTo(hero::class);
    }
}
