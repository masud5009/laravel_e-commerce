<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','category_id','created_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function childcategory()
    {
        return $this->hasMany(ChildCategory::class);
    }
}
