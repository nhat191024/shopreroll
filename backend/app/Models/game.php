<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'name',
        'status',
    ];

    public function GameWeapon()
    {
        return $this->hasMany(weapon::class);
    }

    public function GameHero()
    {
        return $this->hasMany(hero::class);
    }

    public function GameCategory()
    {
        return $this->hasMany(game_category::class);
    }
}
