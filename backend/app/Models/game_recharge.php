<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_recharge extends Model
{
    protected $table = 'game_recharges';
    protected $fillable = [
        'name',
        'tutorial',
        'id_youtube',
        'image',
        'status',
    ];

    public function RechargePackages()
    {
        return $this->hasMany(recharge_package::class);
    }
}
