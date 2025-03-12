<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameItem extends Model
{
    protected $table = 'game_items';

    protected $fillable = [
        'game_id',
        'type',
        'name',
        'description',
        'image',
        'status',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function accountItems()
    {
        return $this->hasMany(AccountItem::class);
    }
}
