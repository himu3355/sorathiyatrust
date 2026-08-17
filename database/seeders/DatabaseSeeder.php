<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\GalleryItem;
use App\Models\News;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@trust.org'],
            [
                'name' => 'શ્રી મહાજન Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Committee Members
        $this->call(CommitteeMemberSeeder::class);

        // Baithaks (84 Baithakji)
        $this->call(BaithakSeeder::class);

        // Sliders
        Slider::firstOrCreate(
            ['title' => 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ'],
            [
                'description' => 'સમાજ ઉત્કર્ષ, શિક્ષણ અને સમરસતાનું પ્રતીક.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // News
        News::firstOrCreate(
            ['slug' => 'saraswati-samman-samaroh-2026'],
            [
                'title' => 'સમાજના તેજસ્વી વિદ્યાર્થીઓ માટે સરસ્વતી સન્માન સમારોહ',
                'summary' => 'ધોરણ ૧૦ અને ૧૨ ના તેજસ્વી વિદ્યાર્થીઓનું ટ્રસ્ટ દ્વારા બહુમાન કરવામાં આવશે.',
                'content' => '<p>શ્રી દશા સોરાઠિયા વણિક સમાજ દ્વારા દર વર્ષની જેમ આ વર્ષે પણ શૈક્ષણિક વર્ષ ૨૦૨૫-૨૬ ના તેજસ્વી તારલાઓનું સન્માન કરવાનો નિર્ણય લેવામાં આવ્યો છે. તમામ વિદ્યાર્થીઓએ પોતાના ગુણપત્રક કાર્યાલય ખાતે જમા કરાવવાના રહેશે.</p>',
                'published_at' => now(),
                'is_featured' => true,
                'is_active' => true,
            ]
        );

        // Events
        Event::firstOrCreate(
            ['slug' => 'annual-general-meeting-2026'],
            [
                'title' => 'વાર્ષિક સામાન્ય સભા ૨૦૨૬',
                'description' => '<p>ટ્રસ્ટના વાર્ષિક હિસાબો અને આગામી આયોજનો અંગે ચર્ચા વિચારણા માટે વાર્ષિક સભા.</p>',
                'location' => 'મહાજન વાડી હોલ, રાજકોટ',
                'event_date' => now()->addDays(15),
                'is_active' => true,
            ]
        );

        // Advertisements
        Advertisement::firstOrCreate(
            ['title' => 'શુભેચ્છક - આણંદપરા ફર્નિચર'],
            [
                'position' => 'home_hero',
                'link_url' => 'https://example.com',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // Sample Gallery Items (Photos & YouTube Videos)
        GalleryItem::firstOrCreate(
            ['title' => 'સ્નેહ મિલન મહોત્સવ - સમાજ આગેવાનો અને ટ્રસ્ટીશ્રીઓ'],
            [
                'type' => 'image',
                'category' => 'સ્નેહ મિલન',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        GalleryItem::firstOrCreate(
            ['title' => 'મહાજન વાડી પરિસર અને હોલ નજારો'],
            [
                'type' => 'image',
                'category' => 'મહાજન વાડી',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );
    }
}
