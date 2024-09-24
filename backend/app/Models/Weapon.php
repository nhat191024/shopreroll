<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $table = 'weapons';
    protected $fillable = [
        'game_id',
        'name',
        'status',
        'image',
    ];

    public function Game()
    {
        return $this->belongsTo(Game::class);
    }

    public function AccountWeapon()
    {
        return $this->hasMany(AccountWeapon::class);
    }
}
