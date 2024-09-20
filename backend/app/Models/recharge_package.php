<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recharge_package extends Model
{
    protected $table = 'recharge_packages';
    protected $fillable = [
        'game_recharge_id',
        'name',
        'price',
        'description',
        'status',
    ];

    public function GameRecharge()
    {
        return $this->belongsTo(game_recharge::class);
    }
}
