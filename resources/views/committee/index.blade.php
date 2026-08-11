@extends('layouts.app')

@section('title', 'હોદ્દેદારો અને કારોબારી સભ્યો - શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')
@section('meta_description', 'શ્રી દશા સોરાઠિયા વણિક જ્ઞાતિ સમાજ (મહાજન) રાજકોટ ના સન્માનનીય હોદ્દેદારો અને કારોબારી સમિતિ સભ્યોની યાદી.')

@section('content')
    <x-page-header icon="fa-solid fa-user-tie" title="હોદ્દેદારો તેમજ કારોબારી સભ્યો"
        subtitle="શ્રી દશા સોરાઠિયા વણિક જ્ઞાતિ સમાજ (મહાજન), રાજકોટ - ટ્રસ્ટી સમિતિ અને કારોબારી સંગઠન" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16" x-data="{
        modalOpen: false,
        member: null,
        openMemberModal(data) {
            this.member = data;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.member = null;
        }
    }">

        <!-- 1. Office Bearers Section (હોદ્દેદારો) -->
        <div>
            <div class="border-b border-slate-200 pb-4 mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center text-lg shadow-md">
                            <i class="fa-solid fa-crown text-slate-950"></i>
                        </span>
                        <span>સન્માનનીય હોદ્દેદારો (Office Bearers)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજના વહીવટ અને માર્ગદર્શન અર્થે વરાયેલ મુખ્ય હોદ્દેદારો
                    </p>
                </div>
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
                <div class="bg-white rounded-3xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    હોદ્દેદારોની વિગત અહિયાં દર્શાવાશે.
                </div>
            @endif
        </div>

        <!-- 2. Executive Committee Members Section (કારોબારી સભ્યો) -->
        <div>
            <div class="border-b border-slate-200 pb-4 mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 flex items-center justify-center text-lg shadow-md">
                            <i class="fa-solid fa-user-group text-amber-400"></i>
                        </span>
                        <span>કારોબારી સમિતિ સભ્યો (Executive Committee Members)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                        સમાજ વિકાસ અને વિવિધ સમિતિ પ્રવૃત્તિઓના કારોબારી સભ્યો
                    </p>
                </div>
                <span class="px-3.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold border border-slate-300 font-gujarati hidden sm:inline-block">
                    કુલ {{ $executiveMembers->count() }} સભ્યો
                </span>
            </div>

            @if ($executiveMembers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach ($executiveMembers as $member)
                        <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-4 text-left cursor-pointer group"
                            @click="openMemberModal({{ json_encode([
                                'name_guj' => $member->name_guj,
                                'name_eng' => $member->name_eng,
                                'designation_guj' => $member->designation_guj,
                                'designation_eng' => $member->designation_eng,
                                'category' => 'કારોબારી સમિતિ સભ્ય (Executive Member)',
                                'photo' => $member->photo_path ? Storage::url($member->photo_path) : null,
                                'initial' => $member->initial,
                                'mobile' => $member->mobile,
                                'email' => $member->email,
                            ]) }})">
                            <!-- Member Photo / Avatar -->
                            <div class="w-16 h-16 flex-shrink-0">
                                @if ($member->photo_path)
                                    <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name_guj }}"
                                        class="w-full h-full object-cover rounded-2xl shadow-xs border border-amber-300 group-hover:scale-105 transition-transform" loading="lazy">
                                @else
                                    <div class="w-full h-full rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-extrabold text-xl flex items-center justify-center shadow-xs border border-amber-400/30 font-gujarati">
                                        {{ $member->initial }}
                                    </div>
                                @endif
                            </div>

                            <!-- Member Name & Details -->
                            <div class="space-y-1 min-w-0 flex-grow">
                                <h3 class="text-sm font-bold text-slate-900 font-gujarati line-clamp-1 leading-snug group-hover:text-amber-700 transition-colors">
                                    {{ $member->name_guj }}
                                </h3>
                                <p class="text-[11px] font-semibold text-amber-900 font-gujarati bg-amber-50 rounded-lg py-0.5 px-2 border border-amber-200/60 inline-block">
                                    {{ $member->designation_guj }}
                                </p>
                                <p class="text-[10px] text-amber-700 font-bold font-gujarati flex items-center gap-1">
                                    <span>વિગત જુઓ</span>
                                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl p-8 text-center text-slate-500 border border-slate-200 font-gujarati">
                    કારોબારી સભ્યોની યાદી અહિયાં દર્શાવાશે.
                </div>
            @endif
        </div>

        <!-- 3. Member Full Details Interactive Modal (Popup) -->
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
                    <!-- Member Photo or Avatar Container (Positioned in notch) -->
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

    </div>
@endsection
