@extends('layouts.app')

@section('meta_title', $event->title . ' - કાર્યક્રમ વિગત')
@section('meta_description', Str::limit(strip_tags($event->description ?? $event->title), 155))
@section('og_type', 'article')
@if($event->image_path)
    @section('og_image', Storage::url($event->image_path))
@endif

@section('content')
    <x-page-header icon="fa-solid fa-calendar-days" :title="$event->title" :subtitle="'તારીખ: ' . $event->event_date->format('d M Y - h:i A')" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
            @if($event->image_path)
                <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="w-full max-h-96 object-cover rounded-xl shadow-xs">
            @endif

            <div class="flex flex-wrap gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm font-medium">
                <div class="flex items-center gap-1.5"><i class="fa-regular fa-calendar-days text-amber-600"></i> <span class="text-slate-500">તારીખ:</span> <span class="font-bold text-slate-800">{{ $event->event_date->format('d M Y, h:i A') }}</span></div>
                @if($event->location)
                    <div class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-amber-600"></i> <span class="text-slate-500">સ્થળ:</span> <span class="font-bold text-slate-800">{{ $event->location }}</span></div>
                @endif
            </div>

            @if($event->description)
                <div class="prose max-w-none font-gujarati text-slate-800 text-base leading-relaxed">
                    {!! $event->description !!}
                </div>
            @endif

            @if($event->gallery_images && count($event->gallery_images) > 0)
                <div class="pt-6 border-t border-slate-200 space-y-4">
                    <h3 class="text-lg font-bold text-slate-900 font-gujarati flex items-center gap-2">
                        <i class="fa-solid fa-images text-amber-600"></i>
                        <span>ગેલરી ચિત્રો (Photo Gallery)</span>
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($event->gallery_images as $img)
                            <img src="{{ Storage::url($img) }}" alt="Event photo" class="w-full h-36 object-cover rounded-xl border border-slate-200" loading="lazy">
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pt-6 border-t border-slate-100 flex justify-between items-center">
                <a href="{{ route('events.upcoming') }}" class="text-sm font-bold text-red-900 hover:text-red-950 flex items-center gap-2 group/back">
                    <i class="fa-solid fa-arrow-left text-xs group-hover/back:-translate-x-1 transition-transform"></i>
                    <span>પાછા જાઓ (Back to Events)</span>
                </a>
            </div>
        </div>
    </div>
@endsection
