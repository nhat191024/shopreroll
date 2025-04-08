<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameAttribute extends Model
{
    protected $table = 'game_attributes';
    protected $fillable = [
        'game_id',
        'name',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function accountAttributes()
    {
        return $this->hasMany(AccountAttribute::class);
    }
}
