<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameAccount extends Model
{
    protected $table = 'game_accounts';
    protected $fillable = [
        'creator_id',
        'game_id',
        'game_category_id',
        'title',
        'username',
        'password',
        'price_in',
        'price_out',
        'note',
        'status',
    ];

    public function Creator()
    {
        return $this->belongsTo(User::class);
    }

    public function Game()
    {
        return $this->belongsTo(Game::class);
    }

    public function GameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }

    public function AccountAttribute()
    {
        return $this->hasMany(AccountAttribute::class, 'game_account_id');
    }

    public function AccountItem()
    {
        return $this->hasMany(AccountItem::class, 'game_account_id');
    }

    public function AccountImage()
    {
        return $this->hasMany(AccountImage::class);
    }

    public function AccountBill()
    {
        return $this->hasMany(AccountBill::class);
    }
}
