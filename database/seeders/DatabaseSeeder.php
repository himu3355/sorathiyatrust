<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\Family;
use App\Models\FamilyMember;
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
                'name' => 'શ્રી મહાજન ટ્રસ્ટ Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Sliders
        Slider::create([
            'title' => 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ',
            'description' => 'સમાજ ઉત્કર્ષ, શિક્ષણ અને સમરસતાનું પ્રતીક.',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'વાર્ષિક સ્નેહ મિલન ૨૦૨૬',
            'description' => 'સમાજના તમામ પરિવારો માટે સ્નેહ મિલનનું આયોજન.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // News
        News::create([
            'title' => 'સમાજના તેજસ્વી વિદ્યાર્થીઓ માટે સરસ્વતી સન્માન સમારોહ',
            'slug' => 'saraswati-samman-samaroh-2026',
            'summary' => 'ધોરણ ૧૦ અને ૧૨ ના તેજસ્વી વિદ્યાર્થીઓનું ટ્રસ્ટ દ્વારા બહુમાન કરવામાં આવશે.',
            'content' => '<p>શ્રી દશા સોરાઠિયા વણિક સમાજ દ્વારા દર વર્ષની જેમ આ વર્ષે પણ શૈક્ષણિક વર્ષ ૨૦૨૫-૨૬ ના તેજસ્વી તારલાઓનું સન્માન કરવાનો નિર્ણય લેવામાં આવ્યો છે. તમામ વિદ્યાર્થીઓએ પોતાના ગુણપત્રક કાર્યાલય ખાતે જમા કરાવવાના રહેશે.</p>',
            'published_at' => now(),
            'is_featured' => true,
            'is_active' => true,
        ]);
        News::create([
            'title' => 'મહાજન વાડીના નવીનીકરણનું કાર્ય પૂર્ણ',
            'slug' => 'mahajan-vadi-renovation-completed',
            'summary' => 'સમાજના સુવિધાયુક્ત વાડી પરિસરમાં અત્યાધુનિક સુવિધાઓ ઉપલબ્ધ.',
            'content' => '<p>રાજકોટ સ્થિત શ્રી દશા સોરાઠિયા વણિક સમાજ મહાજન વાડીનું નવીનીકરણ કાર્ય સફળતાપૂર્વક પૂર્ણ થયું છે. તમામ સભ્યો પ્રસંગો માટે બુકિંગ કરાવી શકશે.</p>',
            'published_at' => now()->subDays(2),
            'is_featured' => false,
            'is_active' => true,
        ]);

        // Events (Upcoming & Past)
        Event::create([
            'title' => 'વાર્ષિક સામાન્ય સભા ૨૦૨૬',
            'slug' => 'annual-general-meeting-2026',
            'description' => '<p>ટ્રસ્ટના વાર્ષિક હિસાબો અને આગામી આયોજનો અંગે ચર્ચા વિચારણા માટે વાર્ષિક સભા.</p>',
            'location' => 'મહાજન વાડી હોલ, રાજકોટ',
            'event_date' => now()->addDays(15),
            'is_active' => true,
        ]);
        Event::create([
            'title' => 'મહાદાન રક્તદાન શિબિર',
            'slug' => 'blood-donation-camp-2026',
            'description' => '<p>સમાજના સેવાભાવી યુવાનો દ્વારા વિશાળ રક્તદાન શિબિરનું આયોજન.</p>',
            'location' => 'સમુદાય ભવન, રાજકોટ',
            'event_date' => now()->addDays(30),
            'is_active' => true,
        ]);
        Event::create([
            'title' => 'ગત સ્નેહ સંમેલન અને સાંસ્કૃતિક સંધ્યા ૨૦૨૫',
            'slug' => 'cultural-evening-2025',
            'description' => '<p>ગત વર્ષે આયોજિત ભવ્ય સાંસ્કૃતિક સંધ્યા.</p>',
            'location' => 'હેમુ ગઢવી હોલ, રાજકોટ',
            'event_date' => now()->subDays(60),
            'is_active' => true,
        ]);

        // Advertisements
        Advertisement::create([
            'title' => 'શુભેચ્છક - આણંદપરા ફર્નિચર',
            'position' => 'home_hero',
            'link_url' => 'https://example.com',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // Sample Family & Members
        $family = Family::create([
            'family_code' => 'F-001',
            'surname_guj' => 'આણંદપરા',
            'surname_eng' => 'Anandpara',
            'main_member_name_guj' => 'રમેશભાઈ આણંદપરા',
            'main_member_name_eng' => 'Rameshbhai Anandpara',
            'village' => 'રાજકોટ',
            'is_active' => true,
        ]);

        FamilyMember::create([
            'family_id' => $family->id,
            'member_name_guj' => 'રમેશભાઈ આણંદપરા',
            'member_name_eng' => 'Rameshbhai Anandpara',
            'relation' => 'મુખ્ય સભ્ય',
            'is_active' => true,
        ]);
    }
}
