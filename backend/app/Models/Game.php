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

    public function GameWeapon()
    {
        return $this->hasMany(Weapon::class);
    }

    public function GameHero()
    {
        return $this->hasMany(Hero::class);
    }

    public function GameCategory()
    {
        return $this->hasMany(GameCategory::class);
    }
}
