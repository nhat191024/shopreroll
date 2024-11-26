<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RerollKey extends Model
{
    protected $table = 'reroll_keys';
    protected $fillable = [
        'key',
        'status',
        'reroll_package_id'
    ];

    public function RerollPackage()
    {
        return $this->belongsTo(RerollPackage::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(RerollBill::class);
    }
}
