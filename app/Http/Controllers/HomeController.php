<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\CommitteeMember;
use App\Models\Event;
use App\Models\News;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $sliders = Slider::active()->get();

        // Fetch active advertisements for home hero slider carousel
        $heroAds = Advertisement::activePosition('home_hero')->get();
        if ($heroAds->isEmpty()) {
            $heroAds = Advertisement::active()->get();
        }

        $sidebarAd = Advertisement::activePosition('sidebar')->first();
        $footerAd = Advertisement::activePosition('footer')->first();

        $latestNews = News::active()->take(3)->get();
        $upcomingEvents = Event::upcoming()->take(3)->get();
        $pastEvents = Event::past()->take(3)->get();

        // Real Office Bearers (સન્માનનીય હોદ્દેદારો)
        $officeBearers = CommitteeMember::officeBearers()->get();

        $stats = [
            'members' => SiteSetting::get('stat_members_label', '૧૫૦૦+'),
            'years' => SiteSetting::get('stat_years_label', '૫૦+'),
            'events' => SiteSetting::get('stat_events_label', '૨૫+'),
            'commitment' => SiteSetting::get('stat_commitment_label', '૧૦૦%'),
        ];

        return view('home', compact(
            'sliders',
            'heroAds',
            'sidebarAd',
            'footerAd',
            'latestNews',
            'upcomingEvents',
            'pastEvents',
            'officeBearers',
            'stats'
        ));
    }
}
