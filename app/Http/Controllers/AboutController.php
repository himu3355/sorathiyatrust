<?php

namespace App\Http\Controllers;

use App\Models\CommunityMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke()
    {
        $trustees = CommunityMember::committee()->take(6)->get();

        return view('about', compact('trustees'));
    }
}
