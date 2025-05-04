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

    public function RechargeBills()
    {
        return $this->hasManyThrough(
            RechargeBill::class,
            RechargePackage::class,
            'game_recharge_id',
            'recharge_package_id',
            'id',
            'id'
        );
    }
}
