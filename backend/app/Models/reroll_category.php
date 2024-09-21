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
        'note',
        'status',
    ];

    public function SubRerollCategory()
    {
        return $this->hasMany(reroll_sub_category::class);
    }
}
