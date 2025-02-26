<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountHero extends Model
{
    protected $table = 'account_heros';
    protected $fillable = [
        'account_id',
        'hero_id',
    ];

    public function Account()
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function Hero()
    {
        return $this->belongsTo(hero::class);
    }
}
