<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = ['seo_title', 'meta_author', 'meta_description', 'meta_keywords', 'canonical_url', 'google_verification', 'google_analytics', 'alexa_verification'];
}
