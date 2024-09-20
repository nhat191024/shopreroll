<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_category extends Model
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
        return $this->hasMany(game_account::class);
    }
}
