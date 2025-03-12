<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountAttribute extends Model
{
    protected $table = 'account_attributes';
    protected $fillable = [
        'account_id',
        'game_attribute_id',
        'value',
    ];

    public function Account()
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function GameAttribute()
    {
        return $this->belongsTo(GameAttribute::class);
    }
}
