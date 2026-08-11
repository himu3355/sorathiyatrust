<?php

namespace Database\Seeders;

use App\Models\CommitteeMember;
use Illuminate\Database\Seeder;

class CommitteeMemberSeeder extends Seeder
{
    public function run(): void
    {
        $officeBearers = [
            ['name_guj' => 'શ્રી જયેશ કનુભાઈ ધ્રુવ', 'designation_guj' => 'પ્રમુખ', 'sort_order' => 1],
            ['name_guj' => 'શ્રી લલિતભાઈ કે. કુરાણી', 'designation_guj' => 'ઉપપ્રમુખ', 'sort_order' => 2],
            ['name_guj' => 'શ્રી શૈલેષભાઈ એલ. શાહ (લોટીયા)', 'designation_guj' => 'મંત્રી', 'sort_order' => 3],
            ['name_guj' => 'શ્રી જયેશ બી. મહેતા (મુન્નાભાઈ)', 'designation_guj' => 'સહમંત્રી', 'sort_order' => 4],
            ['name_guj' => 'શ્રી મહેશભાઈ વ્રજલાલ જનાણી', 'designation_guj' => 'ખજાનચી', 'sort_order' => 5],
            ['name_guj' => 'શ્રી મુકેશભાઈ એચ. વંકાણી', 'designation_guj' => 'સહખજાનચી', 'sort_order' => 6],
            ['name_guj' => 'શ્રી રાજેશ કનુભાઈ ધ્રુવ', 'designation_guj' => 'ઓડીટર', 'sort_order' => 7],
            ['name_guj' => 'શ્રી મહેશભાઈ એસ. ધાબલીયા', 'designation_guj' => 'સહઓડીટર', 'sort_order' => 8],
        ];

        foreach ($officeBearers as $member) {
            CommitteeMember::firstOrCreate(
                ['name_guj' => $member['name_guj']],
                [
                    'designation_guj' => $member['designation_guj'],
                    'category' => 'office_bearer',
                    'term' => '૨૦૨૫-૨૭',
                    'sort_order' => $member['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $executiveMembers = [
            'શ્રી નિર્મળભાઈ આર. શેઠ',
            'શ્રી પ્રમોદભાઈ એચ. પારેખ',
            'શ્રી ધીરુભાઈ ડી. ધાબલીયા',
            'શ્રી સુરેશભાઈ એસ. માંડાણી',
            'શ્રી શાંતિભાઈ પી. ધાબલીયા',
            'શ્રી જિતેન્દ્રભાઈ એન. આણંદપરા',
            'શ્રી અતુલભાઈ આર. કોઠારી',
            'શ્રી કેતનભાઈ ડી. કાચલીયા',
            'શ્રી વિશાલભાઈ પી. મીઠાણી',
            'શ્રી નટુભાઈ ઓતમચંદ રઘાણી',
            'શ્રી રજનીકાંત બાબુલાલ મલકાણ',
            'શ્રી આશિષ પ્રવિણચંદ્ર શ્રીમાંકર',
            'શ્રી અશોકભાઈ એન. દોશી',
        ];

        $sortIndex = 10;
        foreach ($executiveMembers as $name) {
            CommitteeMember::firstOrCreate(
                ['name_guj' => $name],
                [
                    'designation_guj' => 'કારોબારી સભ્ય',
                    'category' => 'executive_member',
                    'term' => '૨૦૨૫-૨૭',
                    'sort_order' => $sortIndex++,
                    'is_active' => true,
                ]
            );
        }
    }
}
