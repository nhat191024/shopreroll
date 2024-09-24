<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RerollBill extends Model
{
    protected $table = 'reroll_bills';
    protected $fillable = [
        'user_id',
        'reroll_package_id',
        'reroll_key_id',
        'price',
        'status',
    ];

    public function Buyer()
    {
        return $this->belongsTo(User::class);
    }

    public function RerollPackage()
    {
        return $this->belongsTo(RerollPackage::class);
    }

    public function RerollKey()
    {
        return $this->belongsTo(RerollKey::class);
    }
}
