@extends('layouts.app')

@section('title', 'મુખ્ય પૃષ્ઠ - શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')

@section('content')
    <div x-data="{
        modalOpen: false,
        member: null,
        openMemberModal(data) {
            this.member = data;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.member = null;
        },
        adModalOpen: false,
        activeAdImage: null,
        activeAdTitle: null,
        activeAdLink: null,
        openAdModal(image, title, link) {
            this.activeAdImage = image;
            this.activeAdTitle = title;
            this.activeAdLink = link;
            this.adModalOpen = true;
        },
        closeAdModal() {
            this.adModalOpen = false;
            this.activeAdImage = null;
            this.activeAdTitle = null;
            this.activeAdLink = null;
        }
    }">

        <!-- 1. Hero Slider Section -->
        <div class="relative bg-slate-900 text-white overflow-hidden shadow-xl" x-data="{ activeSlide: 0, totalSlides: {{ $sliders->count() > 0 ? $sliders->count() : 1 }} }" x-init="if (totalSlides > 1) { setInterval(() => { activeSlide = (activeSlide + 1) % totalSlides }, 6000) }">
            @if ($sliders->count() > 0)
                <div class="relative min-h-[380px] sm:min-h-[500px] flex items-center">
                    @foreach ($sliders as $index => $slider)
                        <div x-show="activeSlide === {{ $index }}" x-cloak
                            transition:enter="transition ease-out duration-700" transition:enter-start="opacity-0 scale-95"
                            transition:enter-end="opacity-100 scale-100" class="absolute inset-0 w-full h-full">
                            @if ($slider->image_path)
                                <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}"
                                    class="w-full h-full object-cover opacity-40">
                            @else
                                <div class="w-full h-full gradient-header opacity-90"></div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent flex items-center">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
                                    <div class="max-w-2xl space-y-4">
                                        <span
                                            class="inline-block px-3.5 py-1 bg-amber-500/20 text-amber-300 rounded-full text-xs font-bold border border-amber-400/30 font-gujarati">
                                            સમાજ સંસ્થા નોટિસ અને સુચના
                                        </span>
                                        @if ($slider->title)
                                            <h1
                                                class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white font-gujarati leading-tight">
                                                {{ $slider->title }}
                                            </h1>
                                        @endif
                                        @if ($slider->description)
                                            <p class="text-sm sm:text-lg text-slate-200 leading-relaxed font-gujarati">
                                                {{ $slider->description }}
                                            </p>
                                        @endif
                                        @if ($slider->link_url)
                                            <div class="pt-2">
                                                <a href="{{ $slider->link_url }}"
                                                    class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl shadow-lg transition-all hover:scale-105 font-gujarati">
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
                @if ($sliders->count() > 1)
                    <div class="absolute bottom-4 left-0 right-0 z-20 flex justify-center gap-2">
                        @foreach ($sliders as $index => $slider)
                            <button @click="activeSlide = {{ $index }}" class="w-3 h-3 rounded-full transition-all"
                                :class="activeSlide === {{ $index }} ? 'bg-amber-400 w-8' : 'bg-white/40 hover:bg-white/70'"></button>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- Fallback Hero Banner -->
                <div class="relative min-h-[380px] sm:min-h-[480px] gradient-header flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full text-center sm:text-left">
                        <div class="max-w-3xl space-y-4">
                            <span
                                class="inline-block px-3.5 py-1 bg-amber-400/20 text-amber-300 rounded-full text-xs font-bold border border-amber-400/40">
                                સમાજ સેવા અને સંગઠન
                            </span>
                            <h1
                                class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white font-gujarati leading-tight">
                                શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ
                            </h1>
                            <p class="text-base sm:text-xl text-amber-100/90 leading-relaxed font-gujarati">
                                સમાજના બંધુઓ અને પરિવારો માટે એકતા, પ્રગતિ અને સંસ્કૃતિને સમર્પિત ડીજિટલ પોર્ટલ.
                            </p>
                            <div class="flex flex-wrap gap-4 justify-center sm:justify-start pt-2">
                                <a href="{{ route('members.index') }}"
                                    class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl shadow-lg transition-all hover:scale-105 font-gujarati">
                                    સભ્યોની ડિરેક્ટરી (Directory)
                                </a>
                                <a href="{{ route('events.upcoming') }}"
                                    class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-all font-gujarati">
                                    કાર્યક્રમો (Events)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- 2. Home Hero Advertisements Slider Carousel Section (Clean Poster Cards with Side Navigation Arrows) -->
        @if ($heroAds->count() > 0)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 sm:mt-12" x-data="{
                activeSlide: 0,
                total: {{ $heroAds->count() }},
                get maxSlide() {
                    const width = window.innerWidth;
                    const visibleCount = width >= 1024 ? 4 : (width >= 640 ? 2 : 1);
                    return Math.max(0, this.total - visibleCount);
                },
                next() {
                    if (this.activeSlide < this.maxSlide) {
                        this.activeSlide++;
                    } else {
                        this.activeSlide = 0;
                    }
                },
                prev() {
                    if (this.activeSlide > 0) {
                        this.activeSlide--;
                    } else {
                        this.activeSlide = this.maxSlide;
                    }
                }
            }">
                <!-- Section Header -->
                <div class="mb-6 border-b border-slate-200 pb-4">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <i class="fa-solid fa-rectangle-ad text-amber-700"></i>
                        <span>સમાજ સ્પોન્સર્સ અને જાહેરાતો (Sponsors & Advertisements)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજના શુભેચ્છકો અને સહયોગી સંસ્થાઓની જાહેરાતો
                    </p>
                </div>

                <!-- Ad Carousel Track Container with Flanking Arrow Buttons -->
                <div class="relative px-2 sm:px-4">
                    <!-- Left Navigation Arrow Button (Positioned Beside Carousel) -->
                    @if ($heroAds->count() > 1)
                        <button @click="prev()"
                            class="absolute -left-2 sm:-left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/95 text-slate-800 hover:bg-amber-600 hover:text-white border border-slate-200/90 shadow-xl backdrop-blur-md flex items-center justify-center transition-all hover:scale-110 active:scale-95"
                            title="પાછળની જાહેરાત (Previous)">
                            <i class="fa-solid fa-chevron-left text-sm sm:text-base"></i>
                        </button>
                    @endif

                    <!-- Right Navigation Arrow Button (Positioned Beside Carousel) -->
                    @if ($heroAds->count() > 1)
                        <button @click="next()"
                            class="absolute -right-2 sm:-right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/95 text-slate-800 hover:bg-amber-600 hover:text-white border border-slate-200/90 shadow-xl backdrop-blur-md flex items-center justify-center transition-all hover:scale-110 active:scale-95"
                            title="આગળની જાહેરાત (Next)">
                            <i class="fa-solid fa-chevron-right text-sm sm:text-base"></i>
                        </button>
                    @endif

                    <!-- Carousel Track -->
                    <div class="overflow-hidden py-2 rounded-3xl">
                        <div class="flex transition-transform duration-500 ease-out gap-4 sm:gap-6"
                            :style="'transform: translateX(-' + (activeSlide * (window.innerWidth >= 1024 ? 25 : (window.innerWidth >= 640 ? 50 : 100))) + '%)'">
                            @foreach ($heroAds as $ad)
                                <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] flex-shrink-0 flex">
                                    <!-- Clean Full Poster Card (Without Bottom Text Box) -->
                                    <div class="relative w-full h-80 sm:h-96 md:h-[410px] rounded-3xl bg-gradient-to-b from-amber-50/70 via-slate-50 to-amber-50/40 p-3 sm:p-4 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex items-center justify-center overflow-hidden group cursor-pointer"
                                        @click="openAdModal('{{ $ad->image_path ? Storage::url($ad->image_path) : '' }}', '{{ addslashes($ad->title) }}', '{{ $ad->link_url ?? '' }}')">
                                        
                                        @if ($ad->image_path)
                                            <img src="{{ Storage::url($ad->image_path) }}" alt="{{ $ad->title }}"
                                                class="max-w-full max-h-full object-contain rounded-2xl shadow-2xs group-hover:scale-103 transition-transform duration-300"
                                                loading="lazy">
                                        @else
                                            <div class="w-full h-full rounded-2xl gradient-header text-amber-200 font-extrabold text-xl flex items-center justify-center p-4 text-center font-gujarati">
                                                📣 {{ $ad->title }}
                                            </div>
                                        @endif



                                        <!-- Overlay Action Buttons (External Link & Expand Lightbox) -->
                                        <div class="absolute bottom-3 right-3 flex items-center gap-2 z-10">
                                            @if ($ad->link_url)
                                                <a href="{{ $ad->link_url }}" target="_blank" rel="noopener" @click.stop
                                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-900/90 hover:bg-amber-600 text-white flex items-center justify-center text-xs shadow-md transition-all hover:scale-110"
                                                    title="લીંક જુઓ (Visit Link)">
                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            @endif
                                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-900/90 text-white flex items-center justify-center text-xs shadow-md group-hover:scale-110 transition-transform"
                                                title="મોટું કરીને જુઓ (Enlarge)">
                                                <i class="fa-solid fa-expand"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <!-- 3. Community Impact & Statistics Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div
                class="bg-gradient-to-r from-amber-950 via-amber-900 to-slate-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-amber-500/30">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                    <div
                        class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                        <div
                            class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">
                            {{ $stats['members'] ?? '૧૫૦૦+' }}</div>
                        <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">નોંધાયેલ સમાજ સભ્યો
                        </div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                        <div
                            class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">
                            {{ $stats['years'] ?? '૫૦+' }}</div>
                        <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">વર્ષોની સેવા પરંપરા
                        </div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                        <div
                            class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">
                            {{ $stats['events'] ?? '૨૫+' }}</div>
                        <div class="text-xs sm:text-sm text-slate-300 font-semibold mt-1 font-gujarati">વાર્ષિક સ્નેહ મિલન અને
                            કાર્યક્રમો</div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs hover:bg-white/10 transition-all">
                        <div
                            class="w-12 h-12 mx-auto rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-3">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <div class="text-2xl sm:text-4xl font-extrabold text-amber-300 font-sans">
                            {{ $stats['commitment'] ?? '૧૦૦%' }}</div>
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
                            <i class="fa-solid fa-newspaper text-amber-700"></i>
                            <span>તાજા સમાચાર (Latest News)</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                            સમાજની નવીનતમ પ્રવૃત્તિઓ, ઘોષણાઓ અને પત્રો
                        </p>
                    </div>
                    <a href="{{ route('news.index') }}"
                        class="text-xs sm:text-sm font-bold text-amber-800 hover:text-amber-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                        <span>તમામ સમાચાર જુઓ</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                @if ($latestNews->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($latestNews as $news)
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
                            <i class="fa-solid fa-calendar-days text-amber-700"></i>
                            <span>આગામી કાર્યક્રમો (Upcoming Events)</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                            સમાજ દ્વારા આયોજિત થનાર ભાવિ કાર્યક્રમો અને બેઠકો
                        </p>
                    </div>
                    <a href="{{ route('events.upcoming') }}"
                        class="text-xs sm:text-sm font-bold text-amber-800 hover:text-amber-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                        <span>તમામ કાર્યક્રમો જુઓ</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                @if ($upcomingEvents->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($upcomingEvents as $event)
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
                            <i class="fa-solid fa-images text-amber-700"></i>
                            <span>ગત કાર્યક્રમ આર્કાઇવ (Past Event Highlights)</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                            સફળતાપૂર્વક યોજાયેલ સમેલનો અને મહોત્સવોની યાદો
                        </p>
                    </div>
                    <a href="{{ route('events.past') }}"
                        class="text-xs sm:text-sm font-bold text-amber-800 hover:text-amber-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                        <span>ગત કાર્યક્રમો સંગ્રહ</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                @if ($pastEvents->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($pastEvents as $event)
                            <x-event-card :event="$event" />
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                        ગત કાર્યક્રમોનો આર્કાઇવ ટૂંક સમયમાં અહિયાં દર્શાવાશે.
                    </div>
                @endif
            </div>

            <!-- 8. Real Office Bearers (સન્માનનીય હોદ્દેદારો) Section -->
            <div>
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                            <span class="w-9 h-9 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center text-base shadow-sm">
                                <i class="fa-solid fa-crown text-slate-950"></i>
                            </span>
                            <span>સન્માનનીય હોદ્દેદારો (Office Bearers)</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                            સમાજના વહીવટ અને માર્ગદર્શન અર્થે વરાયેલ મુખ્ય હોદ્દેદારો
                        </p>
                    </div>
                    <a href="{{ route('about') }}#committee"
                        class="text-xs sm:text-sm font-bold text-amber-800 hover:text-amber-900 transition-colors font-gujarati whitespace-nowrap flex items-center gap-1.5 group">
                        <span>હોદ્દેદારો અને કારોબારી સભ્યો</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                @if ($officeBearers->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($officeBearers as $member)
                            <div class="bg-white rounded-3xl p-6 text-center space-y-4 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group cursor-pointer"
                                @click="openMemberModal({{ json_encode([
                                    'name_guj' => $member->name_guj,
                                    'name_eng' => $member->name_eng,
                                    'designation_guj' => $member->designation_guj,
                                    'designation_eng' => $member->designation_eng,
                                    'category' => 'સન્માનનીય હોદ્દેદાર (Office Bearer)',
                                    'photo' => $member->photo_path ? Storage::url($member->photo_path) : null,
                                    'initial' => $member->initial,
                                    'mobile' => $member->mobile,
                                    'email' => $member->email,
                                ]) }})">
                                <!-- Top Accent Ribbon -->
                                <div class="absolute top-0 left-0 right-0 h-1.5 gradient-header"></div>

                                <!-- Photo / Avatar -->
                                <div class="relative w-24 h-24 mx-auto">
                                    @if ($member->photo_path)
                                        <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name_guj }}"
                                            class="w-full h-full object-cover rounded-2xl shadow-md border-2 border-amber-400 group-hover:scale-105 transition-transform" loading="lazy">
                                    @else
                                        <div class="w-full h-full rounded-2xl gradient-header text-white font-extrabold text-3xl flex items-center justify-center shadow-md border-2 border-amber-400 font-gujarati">
                                            {{ $member->initial }}
                                        </div>
                                    @endif
                                    <div class="absolute -bottom-2 right-0 w-7 h-7 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center text-xs shadow-md border-2 border-white">
                                        <i class="fa-solid fa-crown text-[10px]"></i>
                                    </div>
                                </div>

                                <!-- Name & Designation -->
                                <div class="space-y-1.5">
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900 font-gujarati leading-tight group-hover:text-amber-700 transition-colors">
                                        {{ $member->name_guj }}
                                    </h3>
                                    @if ($member->name_eng)
                                        <p class="text-xs text-slate-400 font-medium">{{ $member->name_eng }}</p>
                                    @endif
                                    <div>
                                        <span class="inline-block px-3 py-1 rounded-xl bg-amber-600 text-white text-xs font-extrabold shadow-2xs font-gujarati">
                                            {{ $member->designation_guj }}
                                        </span>
                                    </div>
                                </div>

                                <!-- View Details Helper Button -->
                                <div class="pt-2 border-t border-slate-100">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 group-hover:text-amber-800 font-gujarati">
                                        <span>સંપૂર્ણ વિગત જુઓ</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                        સન્માનનીય હોદ્દેદારોની યાદી અહિયાં દર્શાવાશે.
                    </div>
                @endif
            </div>

            <!-- 9. Additional Trust Information Banner -->
            <div class="gradient-header rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none">
                </div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    <div class="lg:col-span-2 space-y-4">
                        <span
                            class="inline-flex items-center gap-2 px-3.5 py-1 bg-white/20 text-white rounded-full text-xs font-bold border border-white/30 font-gujarati">
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
                        <a href="{{ route('contact') }}"
                            class="inline-block text-center px-6 py-3.5 bg-white text-amber-950 hover:bg-amber-100 font-bold rounded-xl shadow-md transition-all font-gujarati">
                            📞 કાર્યાલય સંપર્ક (Contact Us)
                        </a>
                        <a href="{{ route('about') }}"
                            class="inline-block text-center px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-all font-gujarati">
                            📜 ટ્રસ્ટ વિગત (About Trust)
                        </a>
                    </div>
                </div>
            </div>

            <!-- 10. Footer Advertisement Banner -->
            <x-ad-banner :ad="$footerAd" />

        </div>

        <!-- 11. Interactive Modal Popup for Home Page Office Bearers -->
        <div x-show="modalOpen" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
            @keydown.escape.window="closeModal()">
            <div class="relative w-full max-w-md bg-white rounded-3xl overflow-hidden shadow-2xl border border-amber-500/30 flex flex-col"
                @click.away="closeModal()">
                
                <!-- Header Banner with Close Button -->
                <div class="gradient-header pt-6 pb-16 px-6 text-white text-center relative overflow-hidden">
                    <button @click="closeModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-400/30 text-amber-200 text-xs font-bold border border-amber-400/40 font-gujarati">
                        <i class="fa-solid fa-user-shield text-amber-300 text-xs"></i>
                        <span x-text="member?.category"></span>
                    </span>
                </div>

                <!-- Body Details -->
                <div class="px-6 pb-6 space-y-5 text-center">
                    <!-- Member Photo or Avatar Container -->
                    <div class="relative w-28 h-28 mx-auto -mt-14">
                        <template x-if="member?.photo">
                            <img :src="member.photo" :alt="member.name_guj" class="w-full h-full object-cover rounded-3xl shadow-xl border-4 border-white bg-slate-900">
                        </template>
                        <template x-if="!member?.photo">
                            <div class="w-full h-full rounded-3xl gradient-header text-white font-extrabold text-4xl flex items-center justify-center shadow-xl border-4 border-white font-gujarati" x-text="member?.initial"></div>
                        </template>
                    </div>

                    <!-- Member Name & Subtitle -->
                    <div class="space-y-1">
                        <h3 class="text-xl sm:text-2xl font-extrabold font-gujarati text-slate-900 leading-tight" x-text="member?.name_guj"></h3>
                        <template x-if="member?.name_eng">
                            <p class="text-xs text-slate-400 font-medium" x-text="member?.name_eng"></p>
                        </template>
                    </div>

                    <!-- Designation Pill -->
                    <div>
                        <span class="inline-block px-4 py-1.5 rounded-2xl bg-amber-600 text-white text-sm font-extrabold shadow-xs font-gujarati" x-text="member?.designation_guj"></span>
                    </div>

                    <!-- Contact Actions -->
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/80 space-y-3">
                        <template x-if="member?.mobile">
                            <div class="flex items-center justify-between gap-2 p-2.5 bg-white rounded-xl border border-slate-200">
                                <div class="flex items-center gap-2 text-slate-700 text-xs font-bold">
                                    <i class="fa-solid fa-phone text-amber-600 text-sm"></i>
                                    <span class="font-mono text-sm" x-text="member.mobile"></span>
                                </div>
                                <a :href="'tel:' + member.mobile" class="px-3 py-1.5 rounded-lg bg-amber-600 text-white text-xs font-bold hover:bg-amber-700 transition-colors font-gujarati flex items-center gap-1">
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <span>કોલ કરો</span>
                                </a>
                            </div>
                        </template>

                        <template x-if="member?.email">
                            <div class="flex items-center justify-between gap-2 p-2.5 bg-white rounded-xl border border-slate-200">
                                <div class="flex items-center gap-2 text-slate-700 text-xs font-bold truncate">
                                    <i class="fa-solid fa-envelope text-amber-600 text-sm"></i>
                                    <span class="truncate" x-text="member.email"></span>
                                </div>
                                <a :href="'mailto:' + member.email" class="px-3 py-1.5 rounded-lg bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition-colors font-gujarati">
                                    ઈમેલ
                                </a>
                            </div>
                        </template>

                        <template x-if="!member?.mobile && !member?.email">
                            <p class="text-xs text-slate-500 font-gujarati">સંપર્ક વિગત ટ્રસ્ટ કાર્યાલય ખાતે ઉપલબ્ધ છે.</p>
                        </template>
                    </div>

                    <!-- Close Action Button -->
                    <div class="pt-1">
                        <button @click="closeModal()" class="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-2xl transition-colors font-gujarati">
                            બંધ કરો (Close)
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- 12. Fullscreen High-Res Advertisement Preview Lightbox Modal -->
        <div x-show="adModalOpen" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-3 sm:p-6"
            @keydown.escape.window="closeAdModal()">
            <div class="relative w-full max-w-3xl max-h-[92vh] bg-white rounded-3xl overflow-hidden shadow-2xl border border-amber-500/40 flex flex-col"
                @click.away="closeAdModal()">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-amber-950 via-amber-900 to-slate-950 text-white flex items-center justify-between">
                    <div class="flex items-center gap-2 min-w-0">
                        <i class="fa-solid fa-rectangle-ad text-amber-400 text-lg"></i>
                        <h3 class="text-base sm:text-lg font-bold font-gujarati truncate" x-text="activeAdTitle"></h3>
                    </div>
                    <button @click="closeAdModal()" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors flex-shrink-0">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Full Size Graphic View (Scrollable / Zoom Container) -->
                <div class="p-4 bg-amber-50/50 flex-grow overflow-auto flex items-center justify-center min-h-[300px]">
                    <template x-if="activeAdImage">
                        <img :src="activeAdImage" :alt="activeAdTitle" class="max-w-full max-h-[72vh] object-contain rounded-2xl shadow-md border border-slate-200">
                    </template>
                    <template x-if="!activeAdImage">
                        <div class="p-12 text-center text-slate-500 font-gujarati font-bold" x-text="activeAdTitle"></div>
                    </template>
                </div>

                <!-- Modal Footer -->
                <div class="p-4 bg-white border-t border-slate-200 flex items-center justify-between gap-4">
                    <template x-if="activeAdLink">
                        <a :href="activeAdLink" target="_blank" rel="noopener" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-bold transition-colors font-gujarati flex items-center gap-2 shadow-sm">
                            <span>લીંક પર જાઓ (Visit Target Link)</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </a>
                    </template>
                    <button @click="closeAdModal()" class="ml-auto px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs sm:text-sm font-bold rounded-xl transition-colors font-gujarati">
                        બંધ કરો (Close)
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
