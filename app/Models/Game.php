<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'name',
        'status',
    ];

    //TODO: remove this
    public function GameWeapon()
    {
        return $this->hasMany(Weapon::class);
    }

    //TODO: remove this
    public function GameHero()
    {
        return $this->hasMany(Hero::class);
    }

    public function GameItem()
    {
        return $this->hasMany(GameItem::class);
    }

    public function GameAttribute()
    {
        return $this->hasMany(GameAttribute::class);
    }

    public function GameCategory()
    {
        return $this->hasMany(GameCategory::class);
    }
}
