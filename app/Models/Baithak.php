<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baithak extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'city_village_guj',
        'city_village_eng',
        'address_guj',
        'address_eng',
        'contact_person_guj',
        'contact_numbers',
        'state',
        'is_apragat',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'number' => 'integer',
        'is_apragat' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
