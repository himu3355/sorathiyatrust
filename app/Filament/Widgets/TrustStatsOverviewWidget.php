<?php

namespace App\Filament\Widgets;

use App\Models\Advertisement;
use App\Models\CommunityMember;
use App\Models\Event;
use App\Models\News;
use App\Models\Slider;
use Filament\Widgets\Widget;

class TrustStatsOverviewWidget extends Widget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected ?string $pollingInterval = '15s';

    protected string $view = 'filament.widgets.society-stats';

    protected function getViewData(): array
    {
        $totalMembers = CommunityMember::count();
        $committeeMembers = CommunityMember::where('is_committee_member', true)->count();
        $activeNews = News::active()->count();
        $upcomingEvents = Event::upcoming()->count();
        $activeAds = Advertisement::where('is_active', true)->count();
        $activeSliders = Slider::where('is_active', true)->count();

        return [
            'stats' => [
                [
                    'value' => number_format($totalMembers),
                    'label_gu' => 'સમાજ સભ્યો',
                    'label_en' => 'Members',
                    'icon' => 'heroicon-o-user-group',
                    'accent' => '#D97706',
                    'tint' => 'rgba(217, 119, 6, 0.25)',
                    'iconColor' => '#F59E0B',
                ],
                [
                    'value' => $activeNews,
                    'label_gu' => 'તાજા સમાચાર',
                    'label_en' => 'News',
                    'icon' => 'heroicon-o-newspaper',
                    'accent' => '#059669',
                    'tint' => 'rgba(5, 150, 105, 0.25)',
                    'iconColor' => '#10B981',
                ],
                [
                    'value' => $upcomingEvents,
                    'label_gu' => 'આગામી કાર્યક્રમો',
                    'label_en' => 'Upcoming Events',
                    'icon' => 'heroicon-o-calendar-days',
                    'accent' => '#E11D48',
                    'tint' => 'rgba(225, 29, 72, 0.25)',
                    'iconColor' => '#F43F5E',
                ],
                [
                    'value' => $activeSliders + $activeAds,
                    'label_gu' => 'જાહેરાતો અને બેનર્સ',
                    'label_en' => 'Media & Ads',
                    'icon' => 'heroicon-o-rectangle-stack',
                    'accent' => '#2563EB',
                    'tint' => 'rgba(37, 99, 235, 0.25)',
                    'iconColor' => '#60A5FA',
                ],
            ],
            'committeeMembers' => $committeeMembers,
        ];
    }
}
