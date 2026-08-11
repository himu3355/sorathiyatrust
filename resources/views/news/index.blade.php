@extends('layouts.app')

@section('title', 'સમાચાર - શ્રી દશા સોરાઠિયા વણિક સમાજ')

@section('content')
    <x-page-header icon="fa-solid fa-newspaper" title="સમાચાર અને વિગત (News & Updates)"
        subtitle="સમાજની પ્રવૃત્તિઓ અને સૂચનાઓ" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Search Filter -->
        <form action="{{ route('news.index') }}" method="GET" class="mb-8 max-w-xl flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="સમાચાર શોધો (Search News...)"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-red-900 bg-white font-gujarati text-sm">
            <button type="submit"
                class="px-6 py-2.5 bg-red-900 text-white font-bold rounded-xl hover:bg-red-950 transition-colors shadow-sm text-sm flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>શોધો</span>
            </button>
        </form>

        @if ($newsList->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($newsList as $item)
                    <x-card>
                        @if ($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div
                                class="w-full h-48 gradient-header flex items-center justify-center text-white font-bold text-lg">
                                સમાચાર
                            </div>
                        @endif
                        <div class="p-5 space-y-3">
                            <div class="text-xs text-slate-500 font-semibold flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-amber-600"></i>
                                <span>{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                            </div>
                            <h2
                                class="text-lg font-bold text-slate-900 font-gujarati line-clamp-2 hover:text-red-900 transition-colors">
                                <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                            </h2>
                            @if ($item->summary)
                                <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 font-gujarati">
                                    {{ $item->summary }}
                                </p>
                            @endif
                            <div class="pt-2">
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="text-xs font-bold text-red-900 hover:text-red-950 inline-flex items-center gap-1.5 font-gujarati group/link">
                                    <span>વાંચો</span>
                                    <i
                                        class="fa-solid fa-arrow-right text-[11px] group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $newsList->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200 font-gujarati">
                કોઈ સમાચાર મળ્યા નથી.
            </div>
        @endif
    </div>
@endsection
