<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_guj',
        'name_eng',
        'designation_guj',
        'designation_eng',
        'category',
        'photo_path',
        'mobile',
        'email',
        'term',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfficeBearers($query)
    {
        return $query->where('category', 'office_bearer');
    }

    public function scopeExecutiveMembers($query)
    {
        return $query->where('category', 'executive_member');
    }

    public function getInitialAttribute(): string
    {
        $name = $this->name_guj ?: $this->name_eng ?: 'સં';
        return mb_substr(preg_replace('/^(શ્રી|સૌ|ડો|કુ)\s+/u', '', $name), 0, 1);
    }
}
