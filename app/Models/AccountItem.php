<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountItem extends Model
{
    protected $table = 'account_items';
    protected $fillable = [
        'game_account_id',
        'game_item_id',
    ];

    public function Account()
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function GameItem()
    {
        return $this->belongsTo(GameItem::class);
    }
}
