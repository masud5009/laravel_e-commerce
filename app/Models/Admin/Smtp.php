<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;
    protected $fillable = [
        'transport',
        'host',
        'encryption',
        'port',
        'user_name',
        'password',
        'from',
    ];
}
