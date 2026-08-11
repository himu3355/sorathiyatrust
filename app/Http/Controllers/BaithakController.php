<?php

namespace App\Http\Controllers;

use App\Models\Baithak;
use Illuminate\Http\Request;

class BaithakController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Baithak::active()->orderBy('number', 'asc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('city_village_guj', 'like', "%{$search}%")
                    ->orWhere('address_guj', 'like', "%{$search}%")
                    ->orWhere('contact_person_guj', 'like', "%{$search}%")
                    ->orWhere('contact_numbers', 'like', "%{$search}%")
                    ->orWhere('number', 'like', "%{$search}%");
            });
        }

        $baithaks = $query->paginate(24)->withQueryString();

        return view('baithak.index', [
            'baithaks' => $baithaks,
            'searchQuery' => $search,
        ]);
    }
}
