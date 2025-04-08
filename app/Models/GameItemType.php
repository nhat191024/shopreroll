<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameItemType extends Model
{
    protected $table = 'game_item_types';

    protected $fillable = [
        'game_id',
        'name',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function gameItems()
    {
        return $this->hasMany(GameItem::class);
    }
}
