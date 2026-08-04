<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ToolController extends Controller
{
    public function index()
    {
        return view('admin.tools');
    }

    /**
     * Export Families to CSV / Excel readable file.
     */
    public function exportFamilies(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="families_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            // Add UTF-8 BOM for Gujarati characters in Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, ['Family Code', 'Main Member (Gujarati)', 'Main Member (English)', 'Surname (Gujarati)', 'Surname (English)', 'Village', 'Address', 'Mobile']);

            Family::active()->chunk(100, function ($families) use ($handle) {
                foreach ($families as $f) {
                    fputcsv($handle, [
                        $f->family_code,
                        $f->main_member_name_guj,
                        $f->main_member_name_eng,
                        $f->surname_guj,
                        $f->surname_eng,
                        $f->village,
                        $f->address,
                        $f->mobile,
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Export Members to CSV / Excel readable file.
     */
    public function exportMembers(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="members_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            // Add UTF-8 BOM for Gujarati characters in Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, ['Member Name (Gujarati)', 'Member Name (English)', 'Relation', 'Age', 'Birth Place', 'Birth Date', 'Marital Status', 'Mosal Surname', 'Education', 'Occupation', 'Mobile']);

            FamilyMember::where('is_active', true)->chunk(100, function ($members) use ($handle) {
                foreach ($members as $m) {
                    fputcsv($handle, [
                        $m->member_name_guj,
                        $m->member_name_eng,
                        $m->relation,
                        $m->age,
                        $m->birth_place,
                        $m->birth_date ? $m->birth_date->format('Y-m-d') : '',
                        $m->marital_status,
                        $m->maternal_surname,
                        $m->education,
                        $m->occupation,
                        $m->mobile,
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Check duplicates in family members (by name or mobile).
     */
    public function checkDuplicates(Request $request)
    {
        $type = $request->input('type', 'member');

        if ($type === 'mobile') {
            $duplicates = FamilyMember::select('mobile', DB::raw('count(*) as total'))
                ->whereNotNull('mobile')
                ->where('mobile', '!=', '')
                ->groupBy('mobile')
                ->having('total', '>', 1)
                ->get();
        } else {
            $duplicates = FamilyMember::select('member_name_guj', DB::raw('count(*) as total'))
                ->whereNotNull('member_name_guj')
                ->where('member_name_guj', '!=', '')
                ->groupBy('member_name_guj')
                ->having('total', '>', 1)
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'type' => $type,
            'data' => $duplicates,
        ]);
    }
}
