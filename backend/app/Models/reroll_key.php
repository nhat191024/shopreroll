<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reroll_key extends Model
{
    protected $table = 'reroll_keys';
    protected $fillable = [
        'key',
        'status',
    ];

    public function RerollPackage()
    {
        return $this->belongsTo(reroll_package::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(reroll_bill::class);
    }
}
