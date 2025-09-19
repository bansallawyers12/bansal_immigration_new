<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relationships
    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->children();
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'parent_category');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSubcategory($query)
    {
        return $query->whereNotNull('parent_id');
    }

    // Accessors & Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $value ?: Str::slug($this->name);
    }

    // Helper methods
    public function isParent()
    {
        return is_null($this->parent_id);
    }

    public function isSubcategory()
    {
        return !is_null($this->parent_id);
    }

    public function getFullNameAttribute()
    {
        if ($this->isParent()) {
            return $this->name;
        }
        
        return $this->parent->name . ' > ' . $this->name;
    }
}