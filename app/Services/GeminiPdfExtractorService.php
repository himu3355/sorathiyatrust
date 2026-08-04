<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GeminiPdfExtractorService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', (string) env('GEMINI_API_KEY', ''));
    }

    /**
     * Extract structured family data from PDF file.
     *
     * @param string $pdfFilePath Absolute path to local PDF file
     * @return array Array of extracted families
     * @throws Exception
     */
    public function extractFamiliesFromPdf(string $pdfFilePath): array
    {
        @set_time_limit(600);
        @ini_set('memory_limit', '512M');

        if (!file_exists($pdfFilePath)) {
            throw new Exception("PDF file not found at path: {$pdfFilePath}");
        }

        $pdfBase64 = base64_encode(file_get_contents($pdfFilePath));

        $prompt = "You are an expert data extractor. I am providing a PDF document which is a family directory (Vastipatrak) in Gujarati.
The document contains information about many families and their members in a tabular/list format.
Your task is to extract all the family data and format it STRICTLY as a JSON array of families.

JSON Schema format:
{
  \"families\": [
    {
      \"family_code\": \"string (e.g. 1453)\",
      \"main_member_name_guj\": \"string (First Name and Father/Husband Name in Gujarati)\",
      \"main_member_name_eng\": \"string (First Name and Father/Husband Name in English if available)\",
      \"surname_guj\": \"string (Surname / Atak in Gujarati)\",
      \"surname_eng\": \"string (Surname / Atak in English)\",
      \"village\": \"string (Native Village / Mool Gam)\",
      \"address\": \"string (Full address without mobile numbers)\",
      \"mobile\": \"string (comma separated if multiple)\",
      \"members\": [
        {
          \"name_guj\": \"string (Full name in Gujarati)\",
          \"name_eng\": \"string (Full name in English)\",
          \"relation\": \"string (e.g. પોતે, પત્ની, પુત્ર, પુત્રી, પૌત્ર, પૌત્રી)\",
          \"age\": \"string (e.g. 55)\",
          \"birth_place\": \"string\",
          \"birth_date\": \"string (Format YYYY-MM-DD if possible, else empty)\",
          \"marital_status\": \"string (Must be 'Married', 'Unmarried', or 'Widowed')\",
          \"maternal_surname\": \"string (Mosal Surname / મોસાળની અટક)\",
          \"education\": \"string (અભ્યાસ)\",
          \"occupation\": \"string (વ્યવસાય)\",
          \"mobile\": \"string\"
        }
      ]
    }
  ]
}

Ensure that marital_status values are ONLY 'Married', 'Unmarried', or 'Widowed'. If it says 'પરિણિત' -> 'Married', 'અપરિણિત' -> 'Unmarried', 'વિધવા/વિધુર' -> 'Widowed'.
Please convert dates like '૧૮-૩-૪૪' or '18-03-44' to '1944-03-18' format.
Output ONLY valid JSON without any markdown formatting wrappers (like ```json), just the raw JSON object. Extract ALL families present in the document.";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'inline_data' => [
                                'mime_type' => 'application/pdf',
                                'data' => $pdfBase64,
                            ],
                        ],
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.1,
                'topK' => 32,
                'topP' => 1,
                'responseMimeType' => 'application/json',
                'response_mime_type' => 'application/json',
            ],
        ];

        $response = Http::withoutVerifying()
            ->timeout(600)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post("{$this->apiUrl}?key={$this->apiKey}", $payload);

        if (!$response->successful()) {
            $errorMsg = $response->json('error.message', 'Unknown Gemini API Error (HTTP ' . $response->status() . ')');
            Log::error("Gemini API Error: {$errorMsg}");
            throw new Exception("Gemini API Error: {$errorMsg}");
        }

        $responseData = $response->json();
        $rawText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$rawText) {
            throw new Exception("Invalid response structure from Gemini API.");
        }

        // Strip Markdown JSON code blocks if present
        $cleanJson = preg_replace('/^```(?:json)?\s*/i', '', trim($rawText));
        $cleanJson = preg_replace('/\s*```$/i', '', $cleanJson);

        $parsed = json_decode(trim($cleanJson), true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($parsed['families'])) {
            throw new Exception("Failed to parse JSON response from Gemini API: " . json_last_error_msg());
        }

        return $parsed['families'];
    }
}
