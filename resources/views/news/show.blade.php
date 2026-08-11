@extends('layouts.app')

@section('meta_title', $news->title . ' - શ્રી દશા સોરાઠિયા વણિક સમાજ')
@section('meta_description', Str::limit(strip_tags($news->summary ?? $news->content), 155))
@section('og_type', 'article')
@if ($news->image_path)
    @section('og_image', Storage::url($news->image_path))
@endif

@section('content')
    <x-page-header icon="fa-solid fa-newspaper" :title="$news->title" :subtitle="'પ્રકાશન તારીખ: ' .
        ($news->published_at ? $news->published_at->format('d M Y - h:i A') : $news->created_at->format('d M Y'))" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main News Article Content -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 sm:p-10 rounded-3xl border border-slate-200/80 shadow-sm">
                @if ($news->image_path)
                    <div class="rounded-2xl overflow-hidden bg-slate-950/90 p-2 sm:p-3 border border-slate-800 shadow-md flex items-center justify-center">
                        <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}"
                            class="w-full max-h-[540px] object-contain rounded-xl" loading="eager">
                    </div>
                @endif

                @if ($news->summary)
                    <div
                        class="p-5 bg-amber-50 rounded-2xl border border-amber-200/60 font-gujarati text-amber-950 text-sm sm:text-base font-semibold leading-relaxed shadow-2xs">
                        {{ $news->summary }}
                    </div>
                @endif

                <div class="prose max-w-none font-gujarati text-slate-800 text-base sm:text-lg leading-relaxed">
                    {!! $news->content !!}
                </div>

                <div class="pt-6 border-t border-slate-200 flex justify-between items-center">
                    <a href="{{ route('news.index') }}"
                        class="text-sm font-bold text-amber-800 hover:text-amber-900 font-gujarati flex items-center gap-2 group/back">
                        <i class="fa-solid fa-arrow-left text-xs group-hover/back:-translate-x-1 transition-transform"></i>
                        <span>તમામ સમાચાર (Back to News)</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar: Recent & Related News -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                    <h3
                        class="text-lg font-bold text-slate-900 font-gujarati border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-amber-600"></i>
                        <span>અન્ય તાજા સમાચાર (Recent News)</span>
                    </h3>

                    @if ($recentNews->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentNews as $recent)
                                <div class="flex items-start gap-3 group">
                                    @if ($recent->image_path)
                                        <div class="w-16 h-16 rounded-xl bg-slate-900 p-0.5 border border-slate-200 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                            <img src="{{ Storage::url($recent->image_path) }}" alt="{{ $recent->title }}"
                                                class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform" loading="lazy">
                                        </div>
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-xl gradient-header text-white font-bold text-xs flex items-center justify-center flex-shrink-0">
                                            સમાચાર
                                        </div>
                                    @endif
                                    <div class="space-y-1">
                                        <h4
                                            class="text-xs sm:text-sm font-bold text-slate-900 font-gujarati group-hover:text-amber-800 transition-colors line-clamp-2">
                                            <a href="{{ route('news.show', $recent->slug) }}">{{ $recent->title }}</a>
                                        </h4>
                                        <p class="text-[11px] text-slate-500 font-medium flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-amber-600"></i>
                                            <span>{{ $recent->published_at ? $recent->published_at->format('d M Y') : $recent->created_at->format('d M Y') }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-500 font-gujarati">કોઈ અન્ય સમાચાર ઉપલબ્ધ નથી.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
