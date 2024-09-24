<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contributor_commission extends Model
{
    protected $table = 'contributor_commissions';
    protected $fillable = [
        'game',
        'commission_percentage',
        'contributor_id',
    ];

    public function Contributor()
    {
        return $this->belongsTo(User::class);
    }
}
