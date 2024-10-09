<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RerollSubCategory extends Model
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
        return $this->belongsTo(RerollCategory::class);
    }

    public function RerollPackage()
    {
        return $this->hasMany(RerollPackage::class);
    }
}
