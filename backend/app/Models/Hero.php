<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
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
        return $this->belongsTo(Game::class);
    }

    public function AccountHero()
    {
        return $this->hasMany(AccountHero::class);
    }
}
