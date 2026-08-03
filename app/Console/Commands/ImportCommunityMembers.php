<?php

namespace App\Console\Commands;

use App\Models\CommunityMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportCommunityMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:community-members 
                            {--fresh : Clear existing community members table before importing} 
                            {--dry-run : Perform analysis and CSV report generation without inserting DB records}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'One-time data migration of community members from source OCR PDF (FINAL INSIDE PG 1 TO 53_ocr.pdf)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pdfPath = base_path('FINAL INSIDE PG 1 TO 53_ocr.pdf');

        if (! file_exists($pdfPath)) {
            $this->error("Source PDF file not found at: {$pdfPath}");
            return Command::FAILURE;
        }

        $this->info("Starting one-time Community Member data migration from: FINAL INSIDE PG 1 TO 53_ocr.pdf");

        // Execute Python parser to extract pages and records cleanly
        $scriptPath = base_path('scratch_pdf_parser.py');
        $jsonOutputPath = storage_path('app/parsed_members.json');
        $csvOutputPath = storage_path('app/member-import-review.csv');

        $pyCode = <<<PYTHON
import pypdf
import json
import re
import csv
import sys

sys.stdout.reconfigure(encoding='utf-8')

pdf_path = r"{$pdfPath}"
reader = pypdf.PdfReader(pdf_path)

guj_digits = str.maketrans('૦૧૨૩૪૫૬૭૮૯', '0123456789')

def normalize_digits(text):
    if not text:
        return ""
    return text.translate(guj_digits)

def extract_mobiles(text):
    text_norm = normalize_digits(text)
    mobiles = re.findall(r'\b[6-9]\d{9}\b', text_norm.replace(' ', '').replace('-', ''))
    if not mobiles:
        raw_nums = re.findall(r'\b[6-9][0-9\s]{8,12}[0-9]\b', text_norm)
        for rn in raw_nums:
            clean = re.sub(r'\D', '', rn)
            if len(clean) == 10 and clean[0] in '6789':
                mobiles.append(clean)
    return list(dict.fromkeys(mobiles))

def clean_gujarati_name(name):
    name = re.sub(r'[\|\:\;\=\~\-\_\.\,\d]', '', name)
    name = re.sub(r'(પોતે|પત્ની|પુત્ર|પુત્રી|પુત્રવધુ|વિધુર|વિધવા).*', '', name)
    name = re.sub(r'\s+', ' ', name).strip()
    return name

parsed_members = []
review_rows = []
seen_mobiles = {}
seen_names = {}

pages_count = len(reader.pages)
records_identified = 0
imported_count = 0
duplicates_count = 0
missing_name_count = 0
missing_mobile_count = 0
invalid_mobile_count = 0
missing_designation_count = 0
manual_review_count = 0

for i, page in enumerate(reader.pages):
    page_no = i + 1
    text = page.extract_text() or ""
    lines = [l.strip() for l in text.split('\\n') if l.strip()]
    
    current_surname = ""
    current_village = ""
    
    for line in lines:
        if "શ્રી દશા સોરાઠેયા" in line or "વસ્તીપત્રક" in line or "અટક" in line or "સભ્યોના નામ" in line or "ઘર તથા વ્યવસાય" in line:
            continue
            
        records_identified += 1
        line_norm = normalize_digits(line)
        mobiles = extract_mobiles(line)
        mobile = mobiles[0] if mobiles else ""
        
        serial_match = re.match(r'^(\d{1,5})\s*\|\s*([^\|]+)\s*\|\s*([^\|]+)\s*\|\s*(.+)', line_norm)
        membership_no = ""
        
        if serial_match:
            membership_no = f"M-{serial_match.group(1)}"
            current_village = serial_match.group(2).strip()
            current_surname = serial_match.group(3).strip()
            raw_name_part = serial_match.group(4).strip()
        else:
            raw_name_part = line.split('|')[0] if '|' in line else line
            
        clean_name = clean_gujarati_name(raw_name_part)
        
        if current_surname and not clean_name.startswith(current_surname):
            full_guj_name = f"{current_surname} {clean_name}".strip()
        else:
            full_guj_name = clean_name
            
        designation = "સમાજ સભ્ય"
        if "પ્રમુખ" in line:
            designation = "પ્રમુખ શ્રી"
        elif "ઉપપ્રમુખ" in line:
            designation = "ઉપપ્રમુખ શ્રી"
        elif "મંત્રી" in line:
            designation = "મંત્રી શ્રી"
        elif "ખજાનચી" in line:
            designation = "ખજાનચી શ્રી"
        elif "ટ્રસ્ટી" in line:
            designation = "ટ્રસ્ટી શ્રી"
        elif "કારોબારી" in line:
            designation = "કારોબારી સભ્ય"
        elif "વેપાર" in line:
            designation = "વેપાર"
        elif "નોકરી" in line or "સર્વીસ" in line:
            designation = "નોકરી / સર્વીસ"
        elif "ગૃહિણી" in line:
            designation = "ગૃહિણી"
        elif "અભ્યાસ" in line:
            designation = "અભ્યાસ"
        else:
            missing_designation_count += 1
            
        needs_review = False
        review_reasons = []
        
        if not clean_name or len(clean_name) < 2:
            missing_name_count += 1
            needs_review = True
            review_reasons.append("Missing or corrupted Gujarati name")
            
        if not mobile:
            missing_mobile_count += 1
        elif len(mobile) != 10:
            invalid_mobile_count += 1
            needs_review = True
            review_reasons.append("Invalid mobile number format")
            
        if mobile and mobile in seen_mobiles:
            duplicates_count += 1
            needs_review = True
            review_reasons.append(f"Duplicate mobile match with page {seen_mobiles[mobile]['page']}")
        elif full_guj_name and full_guj_name in seen_names:
            duplicates_count += 1
            needs_review = True
            review_reasons.append(f"Duplicate name match with page {seen_names[full_guj_name]['page']}")
            
        if mobile:
            seen_mobiles[mobile] = {"page": page_no, "name": full_guj_name}
        if full_guj_name:
            seen_names[full_guj_name] = {"page": page_no, "mobile": mobile}
            
        status = "IMPORTED"
        if needs_review:
            manual_review_count += 1
            status = "NEEDS_MANUAL_REVIEW"
        else:
            imported_count += 1
            
        review_rows.append({
            "source_page": page_no,
            "membership_no": membership_no,
            "extracted_name": full_guj_name,
            "extracted_mobile": mobile,
            "extracted_designation": designation,
            "status": status,
            "reason_for_review": "; ".join(review_reasons) if review_reasons else "OK",
            "raw_line": line[:100]
        })
        
        if not needs_review:
            parsed_members.append({
                "name": full_guj_name,
                "gujarati_name": full_guj_name,
                "designation": designation,
                "mobile_number": mobile,
                "membership_number": membership_no,
                "address": current_village,
                "is_committee_member": designation in ["પ્રમુખ શ્રી", "ઉપપ્રમુખ શ્રી", "મંત્રી શ્રી", "ખજાનચી શ્રી", "ટ્રસ્ટી શ્રી", "કારોબારી સભ્ય"],
                "is_active": True,
            })

with open(r"{$jsonOutputPath}", "w", encoding="utf-8") as f:
    json.dump({
        "pages_processed": pages_count,
        "records_identified": records_identified,
        "imported_count": len(parsed_members),
        "duplicates_count": duplicates_count,
        "missing_name_count": missing_name_count,
        "missing_mobile_count": missing_mobile_count,
        "invalid_mobile_count": invalid_mobile_count,
        "missing_designation_count": missing_designation_count,
        "manual_review_count": manual_review_count,
        "members": parsed_members
    }, f, ensure_ascii=False, indent=2)

with open(r"{$csvOutputPath}", "w", newline="", encoding="utf-8-sig") as csvfile:
    writer = csv.DictWriter(csvfile, fieldnames=["source_page", "membership_no", "extracted_name", "extracted_mobile", "extracted_designation", "status", "reason_for_review", "raw_line"])
    writer.writeheader()
    writer.writerows(review_rows)

PYTHON;

        file_put_contents($scriptPath, $pyCode);

        // Execute Python parser script
        exec("python " . escapeshellarg($scriptPath), $output, $returnCode);

        if (file_exists($scriptPath)) {
            @unlink($scriptPath);
        }

        if ($returnCode !== 0 || ! file_exists($jsonOutputPath)) {
            $this->error("Failed to parse PDF document.");
            return Command::FAILURE;
        }

        $data = json_decode(file_get_contents($jsonOutputPath), true);

        if ($this->option('fresh')) {
            $this->warn("Option --fresh specified: Clearing existing community members table...");
            Schema::disableForeignKeyConstraints();
            DB::table('community_members')->truncate();
            Schema::enableForeignKeyConstraints();
        }

        $isDryRun = $this->option('dry-run');

        if (! $isDryRun) {
            DB::transaction(function () use ($data) {
                $sortOrder = 1;
                foreach ($data['members'] as $memberData) {
                    $memberData['sort_order'] = $sortOrder++;
                    CommunityMember::create($memberData);
                }
            });
        }

        $this->newLine();
        $this->info("================ MIGRATION ANALYSIS & VALIDATION REPORT ================");
        $this->table(
            ['Metric / Question', 'Result Count'],
            [
                ['1. Total PDF Pages Processed', $data['pages_processed']],
                ['2. Total Member Records Identified', $data['records_identified']],
                ['3. Total Members Imported to DB', $isDryRun ? 0 : $data['imported_count']],
                ['4. Total Duplicate Candidates Flagged', $data['duplicates_count']],
                ['5. Total Records with Missing Names', $data['missing_name_count']],
                ['6. Total Records with Missing Mobile Numbers', $data['missing_mobile_count']],
                ['7. Total Records with Invalid Mobile Numbers', $data['invalid_mobile_count']],
                ['8. Total Records with Default Designation', $data['missing_designation_count']],
                ['9. Total Records Requiring Manual Review', $data['manual_review_count']],
                ['10. Records Unparseable / Corrupted', $data['missing_name_count']],
            ]
        );

        $this->newLine();
        $this->info("CSV Review Report generated at: storage/app/member-import-review.csv");

        if ($isDryRun) {
            $this->warn("DRY RUN completed. No records were written to the database.");
        } else {
            $this->info("SUCCESS: Community Member data migration completed successfully!");
        }

        return Command::SUCCESS;
    }
}
