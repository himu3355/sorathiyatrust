<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberPdfSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_member_id',
        'document_title',
        'pdf_path',
        'extracted_text',
        'source_page_number',
        'reference_info',
        'raw_metadata',
    ];

    protected $casts = [
        'source_page_number' => 'integer',
        'raw_metadata' => 'array',
    ];

    public function communityMember(): BelongsTo
    {
        return $this->belongsTo(CommunityMember::class, 'community_member_id');
    }
}
