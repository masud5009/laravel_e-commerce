<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warhouse extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','phone'];
}
