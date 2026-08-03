<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\CommunityMember;
use App\Models\Event;
use App\Models\News;
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
        $committeeMembers = CommunityMember::committee()->take(6)->get();

        return view('home', compact(
            'sliders',
            'heroAd',
            'sidebarAd',
            'footerAd',
            'latestNews',
            'upcomingEvents',
            'pastEvents',
            'committeeMembers'
        ));
    }
}
