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
        'icon',
        'cover_img',
        'description',
        'created_at'
    ];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}
