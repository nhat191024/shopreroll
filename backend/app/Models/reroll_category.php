<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reroll_category extends Model
{
    protected $table = 'reroll_categories';
    protected $fillable = [
        'name',
        'image',
        'status',
    ];
}
