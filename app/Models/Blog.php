<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'author',
        'published_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function scopePublished($query)
    {
        return $query->where('status', true)->where('published_at', '<=', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
