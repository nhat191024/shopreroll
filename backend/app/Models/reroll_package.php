<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reroll_package extends Model
{
    protected $table = 'reroll_packages';
    protected $fillable = [
        'reroll_sub_category_id',
        'name',
        'price',
    ];

    public function RerollSubCategory()
    {
        return $this->belongsTo(reroll_sub_category::class);
    }

    public function RerollKey()
    {
        return $this->hasMany(reroll_key::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(reroll_bill::class);
    }
}
