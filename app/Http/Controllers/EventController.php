<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return redirect()->route('events.upcoming');
    }

    public function upcoming(Request $request)
    {
        $query = Event::upcoming();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->paginate(9)->withQueryString();
        $type = 'upcoming';

        return view('events.index', compact('events', 'type'));
    }

    public function past(Request $request)
    {
        $query = Event::past();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->paginate(9)->withQueryString();
        $type = 'past';

        return view('events.index', compact('events', 'type'));
    }

    public function show(Event $event)
    {
        if (! $event->is_active) {
            abort(404);
        }

        $relatedEvents = Event::active()
            ->where('id', '!=', $event->id)
            ->take(3)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }
}
