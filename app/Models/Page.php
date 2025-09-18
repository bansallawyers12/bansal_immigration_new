<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'template',
        'category',
        'subcategory',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'order',
        'parent_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer',
        'parent_id' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeBySubcategory($query, $subcategory)
    {
        return $query->where('subcategory', $subcategory);
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
