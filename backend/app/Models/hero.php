<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hero extends Model
{
    protected $table = 'heros';
    protected $fillable = [
        'game_id',
        'name',
        'status',
        'image',
    ];

    public function Game()
    {
        return $this->belongsTo(game::class);
    }

    public function AccountHero()
    {
        return $this->hasMany(account_hero::class);
    }
}
