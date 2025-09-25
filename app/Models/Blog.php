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
        'parent_category',
        'short_description',
        'description',
        'image',
        'image_alt',
        'pdf_doc',
        'youtube_url',
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

    // Relationships
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_category');
    }

    // Helper methods
    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->name : 'Uncategorized';
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        
        // Check if image exists in public/img/blog/ directory first
        if (file_exists(public_path('img/blog/' . $this->image))) {
            return asset('img/blog/' . $this->image);
        }
        
        // Fallback to storage directory
        if (file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }

    public function getPdfUrlAttribute()
    {
        return $this->pdf_doc ? asset('storage/' . $this->pdf_doc) : null;
    }

    public function hasVideo()
    {
        return !empty($this->youtube_url) || !empty($this->pdf_doc);
    }

    public function getVideoTypeAttribute()
    {
        if (!empty($this->youtube_url)) {
            return 'youtube';
        } elseif (!empty($this->pdf_doc)) {
            $extension = pathinfo($this->pdf_doc, PATHINFO_EXTENSION);
            return strtolower($extension) === 'mp4' ? 'video' : 'pdf';
        }
        return null;
    }

    public function getReadingTimeAttribute()
    {
        if (empty($this->description)) {
            return 1; // Default 1 minute for empty content
        }
        
        $wordCount = str_word_count(strip_tags($this->description));
        $readingTime = max(1, ceil($wordCount / 200)); // 200 words per minute
        
        return $readingTime;
    }
}
