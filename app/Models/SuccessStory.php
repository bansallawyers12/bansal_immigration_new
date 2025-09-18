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
        'excerpt',
        'content',
        'client_name',
        'client_country',
        'visa_type',
        'image',
        'image_alt',
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
}