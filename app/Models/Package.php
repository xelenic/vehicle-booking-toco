<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $fillable = [
        'package_category_id',
        'media_id',
        'title',
        'slug',
        'description',
        'short_description',
        'duration',
        'price',
        'original_price',
        'image',
        'images',
        'gallery_images',
        'highlights',
        'rating',
        'reviews_count',
        'difficulty',
        'group_size',
        'included',
        'not_included',
        'itinerary',
        'requirements',
        'cancellation_policy',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'images' => 'array',
        'gallery_images' => 'array',
        'highlights' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'reviews_count' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Get the category that owns the package.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }

    /**
     * Get the media that owns the package.
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Get the reviews for the package.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the approved reviews for the package.
     */
    public function approvedReviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    /**
     * Get the featured reviews for the package.
     */
    public function featuredReviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_featured', true)->where('is_approved', true);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->title);
            }
        });

        static::updating(function ($package) {
            if ($package->isDirty('title') && empty($package->slug)) {
                $package->slug = Str::slug($package->title);
            }
        });
    }

    /**
     * Scope a query to only include active packages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured packages.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('package_category_id', $categoryId);
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 0);
    }

    /**
     * Get the formatted original price.
     */
    public function getFormattedOriginalPriceAttribute()
    {
        return $this->original_price ? '$' . number_format($this->original_price, 0) : null;
    }

    /**
     * Get the discount percentage.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        // Priority 1: Use media relationship if available
        if ($this->media) {
            return $this->media->url;
        }
        
        // Priority 2: Use legacy image field
        if ($this->image) {
            // Check if the image path starts with 'slider/' (static images)
            if (str_starts_with($this->image, 'slider/')) {
                return asset($this->image);
            }
            // Otherwise, it's a stored image in the storage directory
            return asset('storage/' . $this->image);
        }
        
        // Default fallback image
        return asset('slider/default-package.jpg');
    }
}
