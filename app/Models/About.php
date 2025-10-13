<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'vision',
        'mission',
        'values',
        'hero_image',
        'hero_media_id',
        'gallery_images',
        'features',
        'team_members',
        'team_member_images',
        'statistics',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'features' => 'array',
        'team_members' => 'array',
        'team_member_images' => 'array',
        'statistics' => 'array',
        'values' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the hero media relationship
     */
    public function heroMedia()
    {
        return $this->belongsTo(Media::class, 'hero_media_id');
    }

    /**
     * Get the hero image URL
     */
    public function getHeroImageUrlAttribute()
    {
        if ($this->heroMedia) {
            return $this->heroMedia->url;
        }
        if ($this->hero_image) {
            if (str_starts_with($this->hero_image, 'slider/')) {
                return asset($this->hero_image);
            }
            return asset('storage/' . $this->hero_image);
        }
        return asset('slider/default-about.jpg');
    }

    /**
     * Get gallery images with URLs
     */
    public function getGalleryImagesWithUrlsAttribute()
    {
        if (!$this->gallery_images) {
            return [];
        }

        return collect($this->gallery_images)->map(function ($imageId) {
            $media = Media::find($imageId);
            return $media ? [
                'id' => $media->id,
                'url' => $media->url,
                'alt' => $media->alt_text ?? 'Gallery Image'
            ] : null;
        })->filter()->toArray();
    }

    /**
     * Scope for active about pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get team members with images
     */
    public function getTeamMembersWithImagesAttribute()
    {
        if (!$this->team_members || !$this->team_member_images) {
            return [];
        }

        $teamMembers = collect($this->team_members);
        $teamImages = collect($this->team_member_images);

        return $teamMembers->map(function ($member, $index) use ($teamImages) {
            $imageData = $teamImages->get($index);
            $member['image_id'] = $imageData['image_id'] ?? null;
            $member['image_url'] = null;
            
            if ($member['image_id']) {
                $media = Media::find($member['image_id']);
                if ($media) {
                    $member['image_url'] = $media->url;
                }
            }
            
            return $member;
        })->toArray();
    }

    /**
     * Scope for ordered about pages
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
