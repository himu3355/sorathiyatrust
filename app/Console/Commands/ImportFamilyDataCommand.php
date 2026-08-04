<?php

namespace App\Console\Commands;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportFamilyDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-family-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import initial family and member seed data from Vastipatrak core dataset';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Family Directory data import...');

        $data = [
            [
                'family_code' => '1404', 'surname_guj' => 'આંટીલા', 'surname_eng' => 'Aantila', 'village' => 'બાધોઈ',
                'address' => "ઘર : ડી-૧૭ હાઉસ નં. ૧, જડેશ્વર પાર્ક મેઇન રોડ-૧,\nઅજયભાઈ પાનની સામે, ખોખડદડ પુલ પાસે, કોઠારીયા, રાજકોટ-૩૬૦૦૦૨.",
                'mobile' => '૯૪ર૮૮ ૯૪૯૧૧, ૯૮૭૫૦ ૯૮૮૦૧',
                'members' => [
                    ['અમૃતલાલ પોપટલાલ', 'Amrutlal Popatlal', 'પોતે', '80', 'બાધોઇ', '1944-03-18', 'વિધુર', 'ધાબલીયા', 'નિવૃત', 'S.S.C'],
                    ['વિજયકુમાર અમૃતલાલ', 'Vijaykumar Amrutlal', 'પુત્ર', '48', 'બાધોઇ', '1975-12-16', 'પરિણીત', 'માંડાણી', 'કંદોઇ', 'H.S.C'],
                    ['સેજલબેન વિજયકુમાર', 'Sejalben Vijaykumar', 'પુત્રવધુ', '44', 'તાંતણિયા', '1980-05-02', 'પરિણીત', 'ધોળકીયા', 'ગૃહિણી', 'H.S.C'],
                    ['ધર્મિષ્ઠા વિજયકુમાર', 'Dharmishtha Vijaykumar', 'પૌત્રી', '20', 'વિરનગર', '2003-11-14', 'અપરિણીત', 'ગાંધી', 'અભ્યાસ', 'College'],
                    ['ધાર્મિક વિજયકુમાર', 'Dharmik Vijaykumar', 'પૌત્ર', '16', 'જેસર', '2007-04-10', 'અપરિણીત', 'ગાંધી', 'અભ્યાસ', 'School'],
                    ['લાલચંદભાઈ અમૃતલાલ', 'Lalchandbhai Amrutlal', 'પુત્ર', '44', 'બાધોઇ', '1980-08-30', 'પરિણીત', 'માંડાણી', 'કંદોઇ', '10 Pass'],
                    ['સારિકાબેન લાલચંદભાઈ', 'Sarikaben Lalchandbhai', 'પુત્રવધુ', '33', 'નાગપુર', '1990-07-07', 'પરિણીત', 'શાહ', 'ગૃહિણી', '12 Pass'],
                    ['તન્મય લાલચંદભાઈ', 'Tanmay Lalchandbhai', 'પૌત્ર', '12', 'જસદણ', '2011-11-23', 'અપરિણીત', 'શાહ', 'અભ્યાસ', 'School'],
                    ['હાર્દિ લાલચંદભાઈ', 'Hardi Lalchandbhai', 'પૌત્રી', '9', 'જસદણ', '2014-10-17', 'અપરિણીત', 'શાહ', 'અભ્યાસ', 'School'],
                    ['અજયકુમાર અમૃતલાલ', 'Ajaykumar Amrutlal', 'પુત્ર', '41', 'બાધોઇ', '1982-08-19', 'પરિણીત', 'માંડાણી', 'કંદોઇ', 'H.S.C'],
                    ['જ્યોતિબેન અજયકુમાર', 'Jyotiben Ajaykumar', 'પુત્રવધુ', '28', 'નાગપુર', '1996-08-05', 'પરિણીત', 'ત્રિવેદી', 'ગૃહિણી', 'B.A'],
                    ['દેવેન્દ્ર અજયકુમાર', 'Devendra Ajaykumar', 'પૌત્ર', '8', 'નાગપુર', '2015-09-03', 'અપરિણીત', 'શર્મા', 'અભ્યાસ', 'School'],
                    ['રિયા અજયકુમાર', 'Riya Ajaykumar', 'પૌત્રી', '4', 'જસદણ', '2019-07-11', 'અપરિણીત', 'શર્મા', 'PLAYHOUSE', 'Pre-School']
                ]
            ],
            [
                'family_code' => '1453', 'surname_guj' => 'આંટીલા', 'surname_eng' => 'Aantila', 'village' => 'બાધોઈ',
                'address' => "ઘર : બ્લોક નં. સી ૫૦૫, પ્રધાનમંત્રી આવાસ,\n૧૫૦ કુટ રીંગ રોડ, વાવડી, રાજકોટ.",
                'mobile' => '૭૩૫૯૮ ૫૦૧૮૬',
                'members' => [
                    ['અનિલ રતિલાલ', 'Anil Ratilal', 'પોતે', '55', 'બાધોઈ', '1969-08-05', 'પરિણીત', 'બાબરીયા', 'ડ્રાઈવીંગ', '૧૦ પાસ'],
                    ['ભારતી અનિલભાઈ', 'Bharti Anilbhai', 'પત્ની', '52', 'જેતપુર', '1971-01-20', 'પરિણીત', 'પારેખ', 'ગૃહકાર્ય', '૧૨ પાસ']
                ]
            ],
            [
                'family_code' => '1705', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'રાજકોટ',
                'address' => "ઘર: એ-૧-૧૦૪, સદગુરૂ વંદનાધામ ફલેટસ-૧,\nઆફ્રિકા કોલોની, ૧૫૦ ફૂટ રીંગ રોડ, રાજકોટ-૩૬૦૦૦૭.",
                'mobile' => '૯૪૨૯૦ ૪૮૧૩૦',
                'members' => [
                    ['અજય મનસુખલાલ', 'Ajay Mansukhlal', 'પોતે', '52', 'રાજકોટ', '1970-09-18', 'પરિણીત', 'સાંગાણી', 'એડવોકેટ', 'B.Com DTLP LLB'],
                    ['મીતા અજય', 'Mita Ajay', 'પત્નિ', '51', 'જામનગર', '1971-07-24', 'પરિણીત', 'શેઠ', 'હાઉસવાઇફ', 'B.Com'],
                    ['કાનન અજય', 'Kanan Ajay', 'પુત્રી', '20', 'રાજકોટ', '2003-06-30', 'અપરિણીત', 'ગાંધી', 'અભ્યાસ', 'B.Com Inter CA']
                ]
            ],
            [
                'family_code' => '2214', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'ભાડેર',
                'address' => "ઘર : સુંદરમ, લક્ષ્મણ ઝુલા શેરી,\nરામકૃષ્ણ ડેરીની સામે, ડો. યાજ્ઞીક રોડ, રાજકોટ.",
                'mobile' => '૯૮૭૯૮ ૨૨૫૨૨',
                'members' => [
                    ['અમોલ છોટાલાલ', 'Amol Chhotalal', 'પોતે', '50', 'જેતપુર', '1974-08-09', 'પરિણીત', 'ગાંધી', 'ટયુશન', 'B.Com'],
                    ['પ્રીતી અમોલ', 'Priti Amol', 'પત્નિ', '40', 'રાજકોટ', '1976-08-28', 'પરિણીત', 'ભુપતાણી', 'ટયુશન', 'B.Com'],
                    ['પાર્થ અમોલ', 'Parth Amol', 'પુત્ર', '23', 'રાજકોટ', '2000-09-01', 'અપરિણીત', 'પારેખ', 'અભ્યાસ', 'B.Com']
                ]
            ],
            [
                'family_code' => '2353', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'જેતપુર',
                'address' => "ઘર : ઓમ, શેરી નં.-૧, સૌરાષ્ટ્ર સોસાયટી,\nસાધુવાસવાણી રોડ, રાજકોટ-૩૬૦૦૦૫.",
                'mobile' => '૯૪૦૮૭ ૮૭૧૪૦',
                'members' => [
                    ['બિપીન પ્રભુદાસ', 'Bipin Prabhudas', 'પોતે', '60', 'જેતપુર', '1955-09-07', 'પરિણીત', 'ધ્રુવ', 'ધંધો', 'કોલેજ'],
                    ['સાધના બીપીનભાઈ', 'Sadhana Bipinbhai', 'પત્નિ', '60', 'ગોંડલ', '1963-12-22', 'પરિણીત', 'સાંગાણી', 'ગૃહિણી', 'બાર પાસ']
                ]
            ],
            [
                'family_code' => '0964', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'ધંધુસર',
                'address' => "ઘર: ફલેટ નં. ૧૦૩, કૃષ્ણ વંદન, ત્રીજો માળ,\nલક્ષ્મીવાડી ૧૦/૧૫ કોર્નર, રાજકોટ.",
                'mobile' => '૯૫૮૬૪ ૮૨૩૬૯',
                'members' => [
                    ['ચંદ્રેશ મહેન્દ્રભાઈ', 'Chandresh Mahendrabhai', 'પોતે', '51', 'રાજકોટ', '1971-12-27', 'પરિણીત', 'બાબરીયા', 'કિશન શુઝ', 'S.S.C'],
                    ['ઇલાબેન ચંદ્રેશભાઈ', 'Ilaben Chandreshbhai', 'પત્ની', '40', 'જામનગર', '1977-04-15', 'પરિણીત', 'સાંગાણી', 'ગૃહિણી', 'M.A'],
                    ['નિરવ ચંદ્રેશભાઈ', 'Nirav Chandreshbhai', 'પુત્ર', '21', 'રાજકોટ', '2003-01-01', 'અપરિણીત', 'મલકાણ', 'અભ્યાસ', 'B.Com'],
                    ['રાખી ચંદ્રેશભાઈ', 'Rakhi Chandreshbhai', 'પુત્રી', '16', 'રાજકોટ', '2008-12-22', 'અપરિણીત', 'મલકાણ', 'અભ્યાસ', 'S.S.C'],
                    ['ભાનુબેન મહેન્દ્રભાઈ', 'Bhanuben Mahendrabhai', 'માતા', '82', 'બર્મા', '1942-01-01', 'વિધવા', 'બાબરીયા', 'ગૃહિણી', 'S.S.C']
                ]
            ],
            [
                'family_code' => '2327', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'જૂનાગઢ',
                'address' => "ઘર : ૨૦૧-નાગેશ્વર પ્રાઇડ, નાગેશ્વર મંદિર રોડ,\nરાજકોટ-૩૬૦૦૦૬.",
                'mobile' => '૯૮૯૮૧ ૩૫૩૪૦',
                'members' => [
                    ['ચિરાગ કિરીટભાઈ', 'Chirag Kiritbhai', 'પોતે', '40', 'જૂનાગઢ', '1983-06-06', 'અપરિણીત', 'સાંગાણી', 'ઇમીટેશન જવેલરી', 'પત્રકાર'],
                    ['ચાંદની કિરીટભાઈ', 'Chandni Kiritbhai', 'બહેન', '37', 'રાજકોટ', '1986-12-04', 'અપરિણીત', 'સાંગાણી', 'ગૃહિણી', 'S.S.C'],
                    ['રંજનબેન કિરીટભાઈ', 'Ranjanben Kiritbhai', 'માતા', '66', 'રાજપરા', '1958-01-13', 'વિધવા', 'બાબરીયા', 'ગૃહિણી', 'S.S.C']
                ]
            ],
            [
                'family_code' => '2573', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'જૂનાગઢ',
                'address' => "ઘર : આરાધના કૃપા, ૪-કામનાથ સોસાયટી,\nહરીધવા મેઇન રોડ, રાજકોટ.",
                'mobile' => '૯૬૩૮૧ ૩૮૭૭૧',
                'members' => [
                    ['દિપકભાઈ શશીકાંતભાઈ', 'Dipakbhai Shashikantbhai', 'પોતે', '49', 'જૂનાગઢ', '1982-04-23', 'પરિણીત', 'ગાદોયા', 'પ્લા.ઝબલાની ફેરી', '૧૦ પાસ'],
                    ['અંજલીબેન દિપકભાઈ', 'Anjaliben Dipakbhai', 'પત્ની', '37', 'રાયપુર', '1987-01-24', 'પરિણીત', 'સોની', 'ગૃહિણી', '૧૨ પાસ'],
                    ['અર્પિતા દિપકભાઈ', 'Arpita Dipakbhai', 'પુત્રી', '18', 'રાજકોટ', '2006-06-21', 'અપરિણીત', 'રોકડે', 'અભ્યાસ', 'કોલેજ'],
                    ['ઇન્દુબેન શશીકાંતભાઈ', 'Induben Shashikantbhai', 'માતા', '66', 'સુલ્તાનપુર', null, 'વિધવા', '-', 'નિવૃત', '-']
                ]
            ],
            [
                'family_code' => '1547', 'surname_guj' => 'આણંદપરા', 'surname_eng' => 'Anandpara', 'village' => 'ધંધુસર',
                'address' => "ઘર : 'જય અંબે', ૧ વિમલનગર, આલાપ સેનચ્યુરી પાછળ,\nયુનીવર્સીટી રોડ, રાજકોટ.",
                'mobile' => '૯૦૩૩૦ ૩૦૦૦૯',
                'members' => [
                    ['દિપક તુલસીદાસ', 'Dipak Tulsidas', 'પોતે', '62', 'રાજકોટ', '1962-03-09', 'પરિણીત', 'પારેખ', 'નોકરી', 'HSC'],
                    ['દિપીકા દિપકભાઈ', 'Dipika Dipakbhai', 'પત્ની', '60', 'મુંબઇ', '1964-05-09', 'પરિણીત', 'ચુડાસમા', 'ગૃહકાર્ય', 'HSC'],
                    ['પ્રણવ દિપકભાઈ', 'Pranav Dipakbhai', 'પુત્ર', '33', 'રાજકોટ', '1990-08-24', 'પરિણીત', 'ગાંધી', 'નોકરી', 'BA'],
                    ['ભુમી પ્રણવભાઈ', 'Bhumi Pranavbhai', 'પુત્રવધુ', '32', 'ગોંડલ', '1991-07-24', 'પરિણીત', 'લોટીયા', 'ગૃહકાર્ય', 'HSC'],
                    ['હર્ષ દિપકભાઈ', 'Harsh Dipakbhai', 'પુત્ર', '28', 'રાજકોટ', '1995-04-01', 'અપરિણીત', 'ગાંધી', 'નોકરી', 'BE MECH.'],
                    ['દર્શ પ્રણવભાઈ', 'Darsh Pranavbhai', 'પૌત્ર', '8', 'રાજકોટ', '2016-11-28', 'અપરિણીત', 'માલવીયા', 'અભ્યાસ', '1st']
                ]
            ]
        ];

        DB::transaction(function () use ($data) {
            foreach ($data as $fam) {
                $mainMemberGuj = $fam['members'][0][0];
                $mainMemberEng = $fam['members'][0][1];

                $searchKeywords = $mainMemberGuj . ' ' . $mainMemberEng . ' ' . $fam['surname_guj'] . ' ' . $fam['surname_eng'] . ' ' . $fam['village'];
                foreach ($fam['members'] as $m) {
                    $searchKeywords .= ' ' . $m[0] . ' ' . $m[1];
                }

                $family = Family::updateOrCreate(
                    ['family_code' => $fam['family_code']],
                    [
                        'main_member_name_guj' => $mainMemberGuj,
                        'main_member_name_eng' => $mainMemberEng,
                        'surname_guj' => $fam['surname_guj'],
                        'surname_eng' => $fam['surname_eng'],
                        'village' => $fam['village'],
                        'city' => 'રાજકોટ',
                        'address' => $fam['address'],
                        'mobile' => $fam['mobile'],
                        'search_keywords' => $searchKeywords,
                        'is_active' => true,
                    ]
                );

                // Re-sync family members
                $family->members()->delete();

                foreach ($fam['members'] as $m) {
                    FamilyMember::create([
                        'family_id' => $family->id,
                        'member_name_guj' => $m[0],
                        'member_name_eng' => $m[1],
                        'relation' => $m[2],
                        'age' => $m[3],
                        'birth_place' => $m[4],
                        'birth_date' => $m[5],
                        'marital_status' => $m[6],
                        'maternal_surname' => $m[7],
                        'occupation' => $m[8],
                        'education' => $m[9] ?? '-',
                        'is_active' => true,
                    ]);
                }
            }
        });

        $this->info('Family Directory data imported successfully!');
    }
}
