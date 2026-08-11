<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;

class AboutController extends Controller
{
    public function __invoke()
    {
        $officeBearers = CommitteeMember::officeBearers()->get();
        $executiveMembers = CommitteeMember::executiveMembers()->get();

        return view('about', compact('officeBearers', 'executiveMembers'));
    }
}
