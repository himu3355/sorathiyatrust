<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function __invoke()
    {
        $featuredIds = SiteSetting::get('featured_trustee_ids', []);
        
        if (!empty($featuredIds) && is_array($featuredIds)) {
            $trustees = FamilyMember::with('family')->whereIn('id', $featuredIds)->get();
        } else {
            $trustees = FamilyMember::with('family')->active()->take(6)->get();
        }

        return view('about', compact('trustees'));
    }
}
