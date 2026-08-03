<?php

namespace App\Models;

use App\Traits\HasBilingualContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommunityMember extends Model
{
    use HasFactory, HasBilingualContent;

    protected $fillable = [
        'name',
        'gujarati_name',
        'designation',
        'mobile_number',
        'photo_path',
        'email',
        'address',
        'membership_number',
        'sort_order',
        'is_committee_member',
        'is_active',
    ];

    protected $casts = [
        'is_committee_member' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function pdfSources(): HasMany
    {
        return $this->hasMany(MemberPdfSource::class, 'community_member_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function scopeCommittee($query)
    {
        return $query->active()->where('is_committee_member', true);
    }
}
