<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RerollPackage extends Model
{
    protected $table = 'reroll_packages';
    protected $fillable = [
        'reroll_sub_category_id',
        'name',
        'price',
    ];

    public function RerollSubCategory()
    {
        return $this->belongsTo(RerollSubCategory::class);
    }

    public function RerollKey()
    {
        return $this->hasMany(RerollKey::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(RerollBill::class);
    }
}
