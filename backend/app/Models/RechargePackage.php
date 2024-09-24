<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargePackage extends Model
{
    protected $table = 'recharge_packages';
    protected $fillable = [
        'game_recharge_id',
        'name',
        'price',
        'status',
    ];

    public function GameRecharge()
    {
        return $this->belongsTo(GameRecharge::class);
    }

    public function RechargeBills()
    {
        return $this->hasMany(RechargeBill::class);
    }
}
