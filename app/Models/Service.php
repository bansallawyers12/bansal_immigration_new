<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'image_alt',
        'icon',
        'category',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
