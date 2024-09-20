<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_account extends Model
{
    protected $table = 'game_accounts';
    protected $fillable = [
        'creator_id',
        'game_category_id',
        'title',
        'username',
        'password',
        'AR',
        'server',
        'price_in',
        'price_out',
        'description',
        'status',
    ];

    public function Creator()
    {
        return $this->belongsTo(user::class);
    }
}
