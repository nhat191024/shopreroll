<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameItem extends Model
{
    protected $table = 'game_items';

    protected $fillable = [
        'game_id',
        'name',
        'description',
        'image',
        'game_item_type_id',
        'status',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function gameItemType()
    {
        return $this->belongsTo(GameItemType::class);
    }

    public function accountItems()
    {
        return $this->hasMany(AccountItem::class);
    }
}
