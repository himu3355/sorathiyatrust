<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_id',
        'member_name_guj',
        'member_name_eng',
        'relation',
        'age',
        'birth_place',
        'birth_date',
        'marital_status',
        'maternal_surname',
        'education',
        'occupation',
        'gender',
        'mobile',
        'is_active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getInitialsAttribute(): string
    {
        $name = $this->member_name_guj ?: $this->member_name_eng;
        if (!$name) return '?';

        $words = explode(' ', trim($name));
        $initials = '';
        foreach ($words as $w) {
            if (mb_strlen($w, 'UTF-8') > 0) {
                $initials .= mb_substr($w, 0, 1, 'UTF-8');
            }
            if (mb_strlen($initials, 'UTF-8') >= 2) break;
        }

        return $initials;
    }

    public function getFormattedMaritalStatusAttribute(): string
    {
        return match ($this->marital_status) {
            'Married', 'પરિણીત' => 'પરિણીત',
            'Unmarried', 'અપરિણીત' => 'અપરિણીત',
            'Widowed', 'વિધવા/વિધુર' => 'વિધવા/વિધુર',
            default => $this->marital_status ?? '-',
        };
    }
}
