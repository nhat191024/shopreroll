<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weapon extends Model
{
    protected $table = 'weapons';
    protected $fillable = [
        'name',
        'price',
        'status',
    ];
}
