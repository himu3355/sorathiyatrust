<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Services\GeminiPdfExtractorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PdfUploadController extends Controller
{
    protected GeminiPdfExtractorService $extractorService;

    public function __construct(GeminiPdfExtractorService $extractorService)
    {
        $this->extractorService = $extractorService;
    }

    public function index()
    {
        return view('admin.pdf_upload');
    }

    public function processPdf(Request $request)
    {
        @set_time_limit(600);
        @ini_set('memory_limit', '512M');

        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:51200', // Allow up to 50MB PDFs
        ]);

        try {
            $pdfFile = $request->file('pdf');
            $tempPath = $pdfFile->getRealPath();

            $families = $this->extractorService->extractFamiliesFromPdf($tempPath);

            return response()->json([
                'status' => 'success',
                'data' => $families,
                'message' => 'Data extracted successfully.',
            ]);
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error("PDF Extraction Failed: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString());

            return response()->json([
                'status' => 'error',
                'message' => 'Extraction failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function saveExtractedData(Request $request)
    {
        $families = $request->input('families');

        if (!$families || !is_array($families)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid family data payload.'], 400);
        }

        try {
            DB::transaction(function () use ($families) {
                foreach ($families as $famData) {
                    $familyCode = trim($famData['family_code'] ?? '');
                    if (empty($familyCode)) continue;

                    $mainMemberGuj = trim($famData['main_member_name_guj'] ?? '');
                    $mainMemberEng = trim($famData['main_member_name_eng'] ?? '');
                    $surnameGuj = trim($famData['surname_guj'] ?? '');
                    $surnameEng = trim($famData['surname_eng'] ?? '');
                    $village = trim($famData['village'] ?? '');

                    $searchKeywords = "{$mainMemberGuj} {$mainMemberEng} {$surnameGuj} {$surnameEng} {$village}";

                    if (isset($famData['members']) && is_array($famData['members'])) {
                        foreach ($famData['members'] as $m) {
                            $searchKeywords .= ' ' . ($m['name_guj'] ?? '') . ' ' . ($m['name_eng'] ?? '');
                        }
                    }

                    $family = Family::updateOrCreate(
                        ['family_code' => $familyCode],
                        [
                            'main_member_name_guj' => $mainMemberGuj,
                            'main_member_name_eng' => $mainMemberEng,
                            'surname_guj' => $surnameGuj,
                            'surname_eng' => $surnameEng,
                            'village' => $village,
                            'city' => 'રાજકોટ',
                            'address' => $famData['address'] ?? null,
                            'mobile' => $famData['mobile'] ?? null,
                            'search_keywords' => $searchKeywords,
                            'is_active' => true,
                        ]
                    );

                    // Re-sync members for this family
                    $family->members()->delete();

                    if (isset($famData['members']) && is_array($famData['members'])) {
                        foreach ($famData['members'] as $m) {
                            $birthDate = null;
                            if (!empty($m['birth_date']) && strlen(trim($m['birth_date'])) >= 4 && strpos($m['birth_date'], '-') !== false) {
                                $ts = strtotime($m['birth_date']);
                                if ($ts) $birthDate = date('Y-m-d', $ts);
                            }

                            FamilyMember::create([
                                'family_id' => $family->id,
                                'member_name_guj' => trim($m['name_guj'] ?? ''),
                                'member_name_eng' => trim($m['name_eng'] ?? ''),
                                'relation' => trim($m['relation'] ?? ''),
                                'age' => trim($m['age'] ?? ''),
                                'birth_place' => trim($m['birth_place'] ?? ''),
                                'birth_date' => $birthDate,
                                'marital_status' => trim($m['marital_status'] ?? ''),
                                'maternal_surname' => trim($m['maternal_surname'] ?? ''),
                                'education' => trim($m['education'] ?? '-'),
                                'occupation' => trim($m['occupation'] ?? '-'),
                                'mobile' => trim($m['mobile'] ?? ''),
                                'is_active' => true,
                            ]);
                        }
                    }
                }
            });

            return response()->json(['status' => 'success', 'message' => 'All families saved successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
