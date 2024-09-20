<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_category extends Model
{
    protected $table = 'game_categories';
    protected $fillable = [
        'game_id',
        'name',
        'image',
        'status',
    ];
}
