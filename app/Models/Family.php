<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_code',
        'main_member_name_guj',
        'main_member_name_eng',
        'surname_guj',
        'surname_eng',
        'village',
        'city',
        'address',
        'mobile',
        'search_keywords',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(FamilyMember::class, 'family_id');
    }

    public function activeMembers(): HasMany
    {
        return $this->members()->where('is_active', true)->orderBy('birth_date', 'asc')->orderBy('id', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('main_member_name_guj', 'like', "%{$term}%")
              ->orWhere('main_member_name_eng', 'like', "%{$term}%")
              ->orWhere('surname_guj', 'like', "%{$term}%")
              ->orWhere('surname_eng', 'like', "%{$term}%")
              ->orWhere('village', 'like', "%{$term}%")
              ->orWhere('family_code', 'like', "%{$term}%")
              ->orWhere('search_keywords', 'like', "%{$term}%");
        });
    }

    public function scopeByLetter($query, string $letter, string $field = 'name')
    {
        if (empty($letter) || $letter === 'all') {
            return $query;
        }

        $column = ($field === 'surname') ? 'surname_guj' : 'main_member_name_guj';

        return $query->where(function ($q) use ($column, $letter) {
            $q->where($column, 'like', $letter . '%')
              ->orWhere($column, 'like', '(' . $letter . '%')
              ->orWhere($column, 'like', ' (' . $letter . '%')
              ->orWhere($column, 'like', '[' . $letter . '%')
              ->orWhere($column, 'like', '"' . $letter . '%')
              ->orWhere($column, 'like', "'" . $letter . '%')
              ->orWhere($column, 'like', ' ' . $letter . '%');
        });
    }
}
