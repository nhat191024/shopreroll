<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weapon extends Model
{
    protected $table = 'weapons';
    protected $fillable = [
        'game_id',
        'name',
        'status',
    ];

    public function Game()
    {
        return $this->belongsTo(game::class);
    }

    public function AccountWeapon()
    {
        return $this->hasMany(account_weapon::class);
    }
}
