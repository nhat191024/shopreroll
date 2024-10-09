<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameAccount extends Model
{
    protected $table = 'game_accounts';
    protected $fillable = [
        'creator_id',
        'game_category_id',
        'title',
        'username',
        'password',
        'AR',
        'server',
        'price_in',
        'price_out',
        'note',
        'status',
    ];

    public function Creator()
    {
        return $this->belongsTo(User::class);
    }

    public function GameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }

    public function AccountWeapon()
    {
        return $this->hasMany(AccountWeapon::class);
    }

    public function AccountHero()
    {
        return $this->hasMany(AccountHero::class);
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
