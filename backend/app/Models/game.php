<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    protected $table = 'game';
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
}
