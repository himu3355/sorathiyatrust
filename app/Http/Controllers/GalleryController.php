<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        $selectedCategory = $request->query('category');

        $query = GalleryItem::active();

        if ($type === 'image') {
            $query->images();
        } elseif ($type === 'video') {
            $query->videos();
        }

        if (!empty($selectedCategory) && $selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        $items = $query->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();

        $categories = GalleryItem::active()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        return view('gallery.index', compact('items', 'type', 'categories', 'selectedCategory'));
    }
}
