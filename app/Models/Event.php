<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'event_date',
        'end_date',
        'image_path',
        'gallery_images',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime',
        'gallery_images' => 'array',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->active()
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc');
    }

    public function scopePast($query)
    {
        return $query->active()
            ->where('event_date', '<', now())
            ->orderBy('event_date', 'desc');
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->event_date >= now();
    }
}
