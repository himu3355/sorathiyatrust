@extends('layouts.app')

@section('title', 'મુખ્ય પૃષ્ઠ - શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ')

@section('content')
    <!-- 1. Hero Slider Section -->
    <div class="relative bg-slate-900 text-white overflow-hidden shadow-xl" x-data="{ activeSlide: 0, totalSlides: {{ $sliders->count() > 0 ? $sliders->count() : 1 }} }" x-init="if (totalSlides > 1) { setInterval(() => { activeSlide = (activeSlide + 1) % totalSlides }, 6000) }">
        @if($sliders->count() > 0)
            <div class="relative min-h-[380px] sm:min-h-[500px] flex items-center">
                @foreach($sliders as $index => $slider)
                    <div x-show="activeSlide === {{ $index }}" x-cloak transition:enter="transition ease-out duration-700" transition:enter-start="opacity-0 scale-95" transition:enter-end="opacity-100 scale-100" class="absolute inset-0 w-full h-full">
                        @if($slider->image_path)
                            <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover opacity-40">
                        @else
                            <div class="w-full h-full gradient-header opacity-90"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent flex items-center">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
                                <div class="max-w-2xl space-y-4">
                                    <span class="inline-block px-3.5 py-1 bg-amber-500/20 text-amber-300 rounded-full text-xs font-bold border border-amber-400/30 font-gujarati">
                                        સમાજ સંસ્થા નોટિસ અને સુચના
                                    </span>
                                    @if($slider->title)
                                        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white font-gujarati leading-tight">
                                            {{ $slider->title }}
                                        </h1>
                                    @endif
                                    @if($slider->description)
                                        <p class="text-sm sm:text-lg text-slate-200 leading-relaxed font-gujarati">
                                            {{ $slider->description }}
                                        </p>
                                    @endif
                                    @if($slider->link_url)
                                        <div class="pt-2">
                                            <a href="{{ $slider->link_url }}" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl shadow-lg transition-all hover:scale-105 font-gujarati">
                                                વધુ માહિતી (Read More) →
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Slider Dots Navigation -->
            @if($sliders->count() > 1)
                <div class="absolute bottom-4 left-0 right-0 z-20 flex justify-center gap-2">
                    @foreach($sliders as $index => $slider)
                        <button @click="activeSlide = {{ $index }}" class="w-3 h-3 rounded-full transition-all" :class="activeSlide === {{ $index }} ? 'bg-amber-400 w-8' : 'bg-white/40 hover:bg-white/70'"></button>
                    @endforeach
                </div>
            @endif
        @else
            <!-- Fallback Hero Banner -->
            <div class="relative min-h-[380px] sm:min-h-[480px] gradient-header flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full text-center sm:text-left">
                    <div class="max-w-3xl space-y-4">
                        <span class="inline-block px-3.5 py-1 bg-amber-400/20 text-amber-300 rounded-full text-xs font-bold border border-amber-400/40">
                            સમાજ સેવા અને સંગઠન
                        </span>
                        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white font-gujarati leading-tight">
                            શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ
                        </h1>
                        <p class="text-base sm:text-xl text-amber-100/90 leading-relaxed font-gujarati">
                            સમાજના બંધુઓ અને પરિવારો માટે એકતા, પ્રગતિ અને સંસ્કૃતિને સમર્પિત ડીજિટલ પોર્ટલ.
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center sm:justify-start pt-2">
                            <a href="{{ route('members.index') }}" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl shadow-lg transition-all hover:scale-105 font-gujarati">
                                સભ્યોની ડિરેક્ટરી (Directory)
                            </a>
                            <a href="{{ route('events.upcoming') }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-all font-gujarati">
                                કાર્યક્રમો (Events)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- 2. Hero Advertisement Banner -->
    <x-ad-banner :ad="$heroAd" class="mt-6" />

    <!-- 3. Community Impact & Statistics Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-amber-500/20">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">{{ $stats['members'] ?? '૧૫૦૦+' }}</div>
                    <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">નોંધાયેલ સમાજ સભ્યો</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                        <i class="fa-solid fa-landmark"></i>
                    </div>
                    <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">{{ $stats['years'] ?? '૫૦+' }}</div>
                    <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">વર્ષોની સેવા પરંપરા</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">{{ $stats['events'] ?? '૨૫+' }}</div>
                    <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">વાર્ષિક સ્નેહ મિલન અને કાર્યક્રમો</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">{{ $stats['commitment'] ?? '૧૦૦%' }}</div>
                    <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">સમાજ કલ્યાણ સમર્પણ</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

        <!-- 4. Latest News Section -->
        <div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <i class="fa-solid fa-newspaper text-emerald-800"></i>
                        <span>તાજા સમાચાર (Latest News)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજની નવીનતમ પ્રવૃત્તિઓ, ઘોષણાઓ અને પત્રો
                    </p>
                </div>
                <a href="{{ route('news.index') }}" class="text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                    <span>તમામ સમાચાર જુઓ</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if($latestNews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($latestNews as $news)
                        <x-news-card :news="$news" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    હાલમાં કોઈ સમાચાર પોસ્ટ કરવામાં આવ્યા નથી.
                </div>
            @endif
        </div>

        <!-- 5. Upcoming Events Section -->
        <div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <i class="fa-solid fa-calendar-days text-emerald-800"></i>
                        <span>આગામી કાર્યક્રમો (Upcoming Events)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજ દ્વારા આયોજિત થનાર ભાવિ કાર્યક્રમો અને બેઠકો
                    </p>
                </div>
                <a href="{{ route('events.upcoming') }}" class="text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                    <span>તમામ કાર્યક્રમો જુઓ</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if($upcomingEvents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($upcomingEvents as $event)
                        <x-event-card :event="$event" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    હાલમાં કોઈ આગામી કાર્યક્રમ આયોજિત નથી.
                </div>
            @endif
        </div>

        <!-- 6. Sidebar / In-between Advertisement Banner -->
        <x-ad-banner :ad="$sidebarAd" />

        <!-- 7. Past Events Highlights Section -->
        <div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <i class="fa-solid fa-images text-emerald-800"></i>
                        <span>ગત કાર્યક્રમ આર્કાઇવ (Past Event Highlights)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સફળતાપૂર્વક યોજાયેલ સમેલનો અને મહોત્સવોની યાદો
                    </p>
                </div>
                <a href="{{ route('events.past') }}" class="text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                    <span>ગત કાર્યક્રમો સંગ્રહ</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if($pastEvents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($pastEvents as $event)
                        <x-event-card :event="$event" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    ગત કાર્યક્રમોનો આર્કાઇવ ટૂંક સમયમાં અહિયાં દર્શાવાશે.
                </div>
            @endif
        </div>

        <!-- 8. Community Members / Leadership Section -->
        <div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <i class="fa-solid fa-user-tie text-emerald-800"></i>
                        <span>ટ્રસ્ટી સમિતિ અને આગેવાનો (Trust Committee)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજનું સંચાલન અને માર્ગદર્શન કરતા માનનીય ટ્રસ્ટીશ્રીઓ
                    </p>
                </div>
                <a href="{{ route('members.index') }}" class="text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                    <span>સંપૂર્ણ સભ્ય ડિરેક્ટરી</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if($committeeMembers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($committeeMembers as $member)
                        <x-member-card :member="$member" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    ટ્રસ્ટી સમિતિ ની યાદી ટૂંક સમયમાં દર્શાવાશે.
                </div>
            @endif
        </div>

        <!-- 9. Additional Trust Information Banner -->
        <div class="gradient-header rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-2 space-y-4">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1 bg-amber-400/20 text-amber-300 rounded-full text-xs font-bold border border-amber-400/30 font-gujarati">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        <span>સમાજ સેવા અને સંપર્ક</span>
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold font-gujarati leading-tight">
                        ટ્રસ્ટની સેવાઓ અને સુવિધાઓ વિશે જાણો
                    </h2>
                    <p class="text-sm sm:text-base text-amber-100/90 leading-relaxed font-gujarati">
                        મહાજન વાડી બુકિંગ, શિષ્યવૃત્તિ અરજીઓ અથવા સભ્યપદ વિગત માટે ટ્રસ્ટ કાર્યાલયનો સંપર્ક કરો.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row lg:flex-col gap-3 justify-center">
                    <a href="{{ route('contact') }}" class="inline-block text-center px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl shadow-md transition-all font-gujarati">
                        📞 કાર્યાલય સંપર્ક (Contact Us)
                    </a>
                    <a href="{{ route('about') }}" class="inline-block text-center px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-all font-gujarati">
                        📜 ટ્રસ્ટ વિગત (About Trust)
                    </a>
                </div>
            </div>
        </div>

        <!-- 9. Footer Advertisement Banner -->
        <x-ad-banner :ad="$footerAd" />

    </div>
@endsection
