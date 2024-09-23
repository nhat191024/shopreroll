<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_image extends Model
{
    protected $table = 'account_images';
    protected $fillable = [
        'game_account_id',
        'image',
    ];

    public function GameAccount()
    {
        return $this->belongsTo(game_account::class);
    }
}
