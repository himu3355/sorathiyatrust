<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::active();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $newsList = $query->paginate(9)->withQueryString();

        return view('news.index', compact('newsList'));
    }

    public function show(News $news)
    {
        // Prevent public access if news is inactive or scheduled for future publication
        if (! $news->is_active || ($news->published_at && $news->published_at > now())) {
            abort(404);
        }

        // Fetch recent/related news excluding current news item
        $recentNews = News::active()
            ->where('id', '!=', $news->id)
            ->take(4)
            ->get();

        return view('news.show', compact('news', 'recentNews'));
    }
}
