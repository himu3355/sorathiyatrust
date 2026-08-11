@extends('layouts.app')

@section('title', ($type === 'upcoming' ? 'આગામી કાર્યક્રમો' : 'ગત કાર્યક્રમો') . ' - શ્રી દશા સોરાઠિયા વણિક સમાજ')

@section('content')
    <x-page-header :icon="$type === 'upcoming' ? 'fa-solid fa-calendar-days' : 'fa-solid fa-images'" :title="$type === 'upcoming' ? 'આગામી કાર્યક્રમો (Upcoming Events)' : 'ગત કાર્યક્રમો આર્કાઇવ (Past Events Archive)'" subtitle="સમાજના આયોજનો અને મહોત્સવો" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Upcoming vs Past Tabs & Search -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
            <div class="flex items-center gap-2 bg-slate-200/80 p-1.5 rounded-xl text-sm font-bold">
                <a href="{{ route('events.upcoming') }}"
                    class="px-5 py-2 rounded-lg transition-all {{ $type === 'upcoming' ? 'bg-red-900 text-white shadow-xs' : 'text-slate-700 hover:text-slate-900' }}">
                    આગામી (Upcoming)
                </a>
                <a href="{{ route('events.past') }}"
                    class="px-5 py-2 rounded-lg transition-all {{ $type === 'past' ? 'bg-red-900 text-white shadow-xs' : 'text-slate-700 hover:text-slate-900' }}">
                    ગત કાર્યક્રમો (Past)
                </a>
            </div>

            <form action="{{ $type === 'upcoming' ? route('events.upcoming') : route('events.past') }}" method="GET"
                class="w-full sm:w-auto flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="કાર્યક્રમ શોધો..."
                    class="px-4 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-red-900 bg-white font-gujarati text-sm">
                <button type="submit"
                    class="px-5 py-2 bg-red-900 text-white font-bold rounded-xl hover:bg-red-950 transition-colors text-sm flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>શોધો</span>
                </button>
            </form>
        </div>

        @if ($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <x-card>
                        @if ($event->image_path)
                            <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div
                                class="w-full h-48 bg-slate-800 text-amber-300 flex items-center justify-center font-bold text-lg">
                                કાર્યક્રમ
                            </div>
                        @endif
                        <div class="p-5 space-y-3">
                            <x-badge :color="$event->event_date >= now() ? 'amber' : 'slate'">
                                {{ $event->event_date >= now() ? 'આગામી' : 'પૂર્ણ' }}
                            </x-badge>
                            <h2
                                class="text-lg font-bold text-slate-900 font-gujarati line-clamp-2 hover:text-red-900 transition-colors">
                                <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                            </h2>
                            <div class="space-y-1.5 text-xs text-slate-600 font-medium">
                                <p class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar-days text-amber-600"></i>
                                    <span
                                        class="font-bold text-slate-800">{{ $event->event_date->format('d M Y - h:i A') }}</span>
                                </p>
                                @if ($event->location)
                                    <p class="flex items-center gap-2">
                                        <i class="fa-solid fa-location-dot text-amber-600"></i>
                                        <span>{{ $event->location }}</span>
                                    </p>
                                @endif
                            </div>
                            <div class="pt-2">
                                <a href="{{ route('events.show', $event->slug) }}"
                                    class="text-xs font-bold text-red-900 hover:text-red-950 inline-flex items-center gap-1.5 font-gujarati group/link">
                                    <span>કાર્યક્રમ વિગત</span>
                                    <i
                                        class="fa-solid fa-arrow-right text-[11px] group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200 font-gujarati">
                કોઈ કાર્યક્રમો મળ્યા નથી.
            </div>
        @endif
    </div>
@endsection
