<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of families with Gujarati alphabet index & search.
     */
    public function index(Request $request)
    {
        $gujaratiLetters = [
            'અ', 'આ', 'ઇ', 'ઈ', 'ઉ', 'ઊ', 'એ', 'ઐ', 'ઓ', 'ઔ',
            'ક', 'ખ', 'ગ', 'ઘ', 'ચ', 'છ', 'જ', 'ઝ', 'ટ', 'ઠ',
            'ડ', 'ઢ', 'ણ', 'ત', 'થ', 'દ', 'ધ', 'ન', 'પ', 'ફ',
            'બ', 'ભ', 'મ', 'ય', 'ર', 'લ', 'વ', 'શ', 'ષ', 'સ', 'હ', 'ળ', 'ક્ષ', 'જ્ઞ'
        ];

        $currentLetter = $request->input('letter', 'all');
        $searchQuery = trim($request->input('search', ''));

        $query = Family::active()->withCount(['members as active_members_count' => function ($q) {
            $q->where('is_active', true);
        }]);

        if (!empty($searchQuery)) {
            $query->search($searchQuery);
        } elseif ($currentLetter !== 'all') {
            $query->byLetter($currentLetter);
        }

        $families = $query->orderBy('surname_guj', 'asc')
            ->orderBy('main_member_name_guj', 'asc')
            ->paginate(12)
            ->withQueryString();

        return view('families.index', compact('families', 'gujaratiLetters', 'currentLetter', 'searchQuery'));
    }

    /**
     * Display detailed profile for a specific family and its members.
     */
    public function show(Family $family)
    {
        if (!$family->is_active) {
            abort(404);
        }

        $family->load(['activeMembers']);

        return view('families.show', compact('family'));
    }
}
