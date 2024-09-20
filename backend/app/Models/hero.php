<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hero extends Model
{
    protected $table = 'heroes';
    protected $fillable = [
        'name',
        'price',
        'status',
    ];

    public function Game()
    {
        return $this->belongsTo(game::class);
    }
}
