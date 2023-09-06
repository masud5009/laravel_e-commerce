<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'images',
        'code',
        'unit',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'featured',
        'today_deal',
        'status',
        'flash_deal_id',
        'user_id',
        'cashon_delivery',
        'warehouse'
    ];
}
