<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_position',
        'page_name',
        'page_title',
        'page_description'
    ];
}
