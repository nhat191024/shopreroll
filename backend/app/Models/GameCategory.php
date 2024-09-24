<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameCategory extends Model
{
    protected $table = 'game_categories';
    protected $fillable = [
        'game_id',
        'name',
        'image',
        'status',
    ];

    public function Game()
    {
        return $this->belongsTo(game::class);
    }

    public function GameAccount()
    {
        return $this->hasMany(GameAccount::class);
    }
}
