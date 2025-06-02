<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingConfig extends Model
{
    protected $table = 'setting_configs';
    protected $fillable = [
        'key',
        'value',
    ];
}
