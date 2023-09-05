<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;
    protected $fillable = [
        'mailer',
        'host',
        'port',
        'user_name',
        'password'
    ];
}
