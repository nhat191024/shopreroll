<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'name',
        'status',
    ];

    public function GameAccount()
    {
        return $this->hasMany(GameAccount::class);
    }

    public function GameItemType()
    {
        return $this->hasMany(GameItemType::class);
    }

    public function GameItem()
    {
        return $this->hasMany(GameItem::class);
    }

    public function GameAttribute()
    {
        return $this->hasMany(GameAttribute::class);
    }

    public function GameCategory()
    {
        return $this->hasMany(GameCategory::class);
    }
}
