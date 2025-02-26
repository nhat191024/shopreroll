<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountWeapon extends Model
{
    protected $table = 'account_weapons';
    protected $fillable = [
        'account_id',
        'weapon_id',
    ];

    public function Account()
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function Weapon()
    {
        return $this->belongsTo(weapon::class);
    }
}
