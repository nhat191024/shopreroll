<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reroll_sub_category extends Model
{
    protected $table = 'reroll_sub_categories';
    protected $fillable = [
        'reroll_category_id',
        'name',
        'tutorial',
        'id_youtube',
        'file_download_link',
        'image',
        'status',
    ];

    public function RerollCategory()
    {
        return $this->belongsTo(reroll_category::class);
    }
}
