<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand',
        'unit',
        'tags',
        'unit_price',
        'discount_date',
        'discount_price',
        'quantity',
        'color',
        'attribute_values',
        'description',
        'free_shipping_status',
        'flat_rate',
        'cash_on_delivery_status',
        'warning_quantity',
        'show_stock_quantity',
        'show_stock_text',
        'hide_stock',
        'featured',
        'todays_deal',
        'active_status',
        'trandy',
        'shipping_day',
        'images',
        'thumbnail',
    ];

    public function subcategories()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
