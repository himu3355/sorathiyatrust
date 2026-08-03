<?php

namespace App\Http\Controllers;

use App\Models\CommunityMember;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = CommunityMember::active();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('gujarati_name', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('committee_only')) {
            $query->where('is_committee_member', true);
        }

        $members = $query->paginate(12)->withQueryString();

        return view('members.index', compact('members'));
    }

    public function show(CommunityMember $member)
    {
        // Security: Prevent public access to inactive members
        if (! $member->is_active) {
            abort(404);
        }

        // Note: Notice that $member->pdfSources relationship is NEVER loaded or exposed in public views to keep PDF/OCR source data strictly isolated.

        return view('members.show', compact('member'));
    }
}
