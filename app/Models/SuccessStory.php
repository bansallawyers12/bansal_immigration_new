<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_category',
        'excerpt',
        'content',
        'client_name',
        'client_country',
        'visa_type',
        'image',
        'image_alt',
        'pdf_doc',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'order',
        'success_date'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer',
        'success_date' => 'date'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByVisaType($query, $visaType)
    {
        return $query->where('visa_type', $visaType);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
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
        return $this->image ? asset('storage/' . $this->image) : null;
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
}