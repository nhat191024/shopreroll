<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RerollCategory extends Model
{
    protected $table = 'reroll_categories';
    protected $fillable = [
        'name',
        'image',
        'note',
        'status',
    ];

    public function SubRerollCategory()
    {
        return $this->hasMany(RerollSubCategory::class);
    }
}
