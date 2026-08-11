<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function index(Request $request)
    {
        $officeBearers = CommitteeMember::active()
            ->officeBearers()
            ->orderBy('sort_order', 'asc')
            ->get();

        $executiveMembers = CommitteeMember::active()
            ->executiveMembers()
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('committee.index', compact('officeBearers', 'executiveMembers'));
    }
}
