<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_account extends Model
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
        'description',
        'status',
    ];

    public function Creator()
    {
        return $this->belongsTo(user::class);
    }

    public function GameCategory()
    {
        return $this->belongsTo(game_category::class);
    }

    public function AccountWeapon()
    {
        return $this->hasMany(account_weapon::class);
    }

    public function AccountHero()
    {
        return $this->hasMany(account_hero::class);
    }

    public function AccountImage()
    {
        return $this->hasMany(account_image::class);
    }
}
