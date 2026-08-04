<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\FamilyMember;
use App\Models\News;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $sliders = Slider::active()->get();
        $heroAd = Advertisement::activePosition('home_hero')->first();
        $sidebarAd = Advertisement::activePosition('sidebar')->first();
        $footerAd = Advertisement::activePosition('footer')->first();
        $latestNews = News::active()->take(3)->get();
        $upcomingEvents = Event::upcoming()->take(3)->get();
        $pastEvents = Event::past()->take(3)->get();

        $featuredIds = SiteSetting::get('featured_trustee_ids', []);
        if (!empty($featuredIds) && is_array($featuredIds)) {
            $committeeMembers = FamilyMember::with('family')->whereIn('id', $featuredIds)->take(6)->get();
        } else {
            $committeeMembers = FamilyMember::with('family')->active()->take(6)->get();
        }

        $stats = [
            'members' => SiteSetting::get('stat_members_label', '૧૫૦૦+'),
            'years' => SiteSetting::get('stat_years_label', '૫૦+'),
            'events' => SiteSetting::get('stat_events_label', '૨૫+'),
            'commitment' => SiteSetting::get('stat_commitment_label', '૧૦૦%'),
        ];

        return view('home', compact(
            'sliders',
            'heroAd',
            'sidebarAd',
            'footerAd',
            'latestNews',
            'upcomingEvents',
            'pastEvents',
            'committeeMembers',
            'stats'
        ));
    }
}
