<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRecharge extends Model
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
        return $this->hasMany(RechargePackage::class);
    }
}
