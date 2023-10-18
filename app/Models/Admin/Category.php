<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'banner',
        'parent_id',
        'icon',
        'cover_img',
        'description',
        'created_at'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
