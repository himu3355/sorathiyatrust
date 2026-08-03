<?php

namespace App\Traits;

trait HasBilingualContent
{
    /**
     * Get the display name respecting Gujarati primary or English fallback.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->gujarati_name ?? $this->name ?? '';
    }

    /**
     * Get the display title respecting Gujarati or English fields.
     */
    public function getDisplayTitleAttribute(): string
    {
        return $this->title_gu ?? $this->title ?? '';
    }

    /**
     * Get the display description respecting Gujarati or English fields.
     */
    public function getDisplayDescriptionAttribute(): string
    {
        return $this->description_gu ?? $this->description ?? '';
    }
}
