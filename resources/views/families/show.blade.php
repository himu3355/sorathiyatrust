@extends('layouts.app')

@section('title', 'પરિવાર પ્રોફાઈલ - શ્રી ' . $family->main_member_name_guj . ' | વસ્તીપત્રક')
@section('meta_description',
    'શ્રી ' .
    $family->main_member_name_guj .
    ' પરિવાર પ્રોફાઈલ અને સભ્યોની વિગત - શ્રી દશા
    સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Back Navigation Button -->
        <div class="mb-6">
            <a href="{{ route('families.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-300 text-slate-800 hover:bg-amber-600 hover:border-amber-600 hover:text-white font-bold text-xs rounded-2xl transition-all shadow-xs group font-gujarati">
                <i class="fa-solid fa-arrow-left text-amber-700 group-hover:text-white transition-colors"></i>
                <span class="group-hover:text-white">પાછા જાઓ (Back to Directory)</span>
            </a>
        </div>

        <!-- Family Banner Header Card -->
        <div
            class="bg-gradient-to-r from-amber-950 via-amber-900 to-slate-950 text-white rounded-3xl p-6 sm:p-10 shadow-xl relative overflow-hidden mb-10 border border-amber-500/30">
            <!-- Decorative Background Pattern -->
            <div class="absolute -right-10 -bottom-10 opacity-10 text-[180px] pointer-events-none text-white font-bold">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10 items-center">
                <div class="md:col-span-2 space-y-4">
                    @if ($family->family_code)
                        <span
                            class="inline-block text-xs font-extrabold uppercase tracking-widest bg-amber-500 text-slate-950 px-3.5 py-1 rounded-full shadow-xs">
                            <i class="fa-solid fa-id-card me-1"></i>આજીવન સભ્ય ક્રમાંક: {{ $family->family_code }}
                        </span>
                    @endif
                    <h1 class="text-2xl sm:text-4xl font-extrabold leading-tight text-white font-gujarati drop-shadow-xs">
                        શ્રી {{ $family->main_member_name_guj }}
                    </h1>
                    @if ($family->main_member_name_eng)
                        <p class="text-amber-200 text-sm font-semibold tracking-wide">{{ $family->main_member_name_eng }}
                        </p>
                    @endif

                    <div class="flex flex-wrap gap-3 pt-2">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/15 backdrop-blur-md text-white text-xs sm:text-sm font-bold border border-white/20 font-gujarati">
                            <i class="fa-solid fa-location-dot text-amber-300"></i>
                            <span>મૂળ ગામ: {{ $family->village ?: 'રાજકોટ' }}</span>
                        </span>
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/15 backdrop-blur-md text-white text-xs sm:text-sm font-bold border border-white/20 font-gujarati">
                            <i class="fa-solid fa-users text-amber-300"></i>
                            <span>અટક: {{ $family->surname_guj }}</span>
                        </span>
                    </div>
                </div>

                <div
                    class="border-t md:border-t-0 md:border-l border-amber-500/30 pt-6 md:pt-0 md:pl-8 space-y-4 text-xs sm:text-sm">
                    @if ($family->address)
                        <div>
                            <div
                                class="text-amber-300 font-bold uppercase tracking-wider text-[11px] mb-1 flex items-center gap-1 font-gujarati">
                                <i class="fa-solid fa-house"></i>
                                <span>ઘર સરનામું</span>
                            </div>
                            <div class="text-slate-100 leading-relaxed font-gujarati font-medium">
                                {!! nl2br(e($family->address)) !!}
                            </div>
                        </div>
                    @endif

                    @if ($family->mobile)
                        <div>
                            <div
                                class="text-amber-300 font-bold uppercase tracking-wider text-[11px] mb-1 flex items-center gap-1 font-gujarati">
                                <i class="fa-solid fa-phone"></i>
                                <span>સંપર્ક નંબર</span>
                            </div>
                            <div class="text-white font-mono font-bold text-sm">
                                {{ $family->mobile }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Family Members Grid Section -->
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 font-gujarati flex items-center gap-3">
                <span class="w-3 h-8 bg-amber-600 rounded-full inline-block"></span>
                <span>પરિવારના સભ્યો ({{ $family->activeMembers->count() }})</span>
            </h2>
        </div>

        @if ($family->activeMembers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($family->activeMembers as $index => $member)
                    <div
                        class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                        <!-- Member Header -->
                        <div class="p-5 border-b border-slate-100 flex items-center gap-4 bg-amber-50/30">
                            <div
                                class="w-14 h-14 rounded-2xl gradient-header text-white border border-amber-400/40 font-extrabold text-xl flex items-center justify-center shadow-md flex-shrink-0 font-gujarati">
                                {{ $member->initials }}
                            </div>
                            <div>
                                <h3
                                    class="text-base font-bold text-slate-900 font-gujarati leading-tight group-hover:text-amber-700 transition-colors">
                                    {{ $member->member_name_guj }}
                                </h3>
                                @if ($member->relation)
                                    <span
                                        class="inline-block mt-1 px-2.5 py-0.5 rounded-lg bg-amber-50 text-amber-900 text-xs font-extrabold border border-amber-200/60 font-gujarati">
                                        {{ $member->relation }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Member Body Info Grid -->
                        <div class="p-6 space-y-4 text-xs sm:text-sm text-slate-800 flex-grow">
                            <div class="grid grid-cols-2 gap-3 pb-3 border-b border-slate-100">
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">ઉંમર</span>
                                    <span
                                        class="font-bold text-slate-900 font-gujarati">{{ $member->age ? $member->age . ' વર્ષ' : '-' }}</span>
                                </div>
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">સ્થિતિ</span>
                                    <span
                                        class="font-bold text-slate-900 font-gujarati">{{ $member->formatted_marital_status }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 pb-3 border-b border-slate-100">
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">જન્મ
                                        સ્થળ</span>
                                    <span
                                        class="font-medium text-slate-800 font-gujarati">{{ $member->birth_place ?: '-' }}</span>
                                </div>
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">જન્મ
                                        તારીખ</span>
                                    <span
                                        class="font-medium text-slate-800 font-mono">{{ $member->birth_date ? $member->birth_date->format('d-m-Y') : '-' }}</span>
                                </div>
                            </div>

                            <div class="space-y-2.5 pt-1">
                                <div class="flex items-start gap-2.5">
                                    <i class="fa-solid fa-graduation-cap w-4 text-amber-700 text-center mt-1"></i>
                                    <div>
                                        <span
                                            class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">અભ્યાસ</span>
                                        <span
                                            class="font-semibold text-slate-900 font-gujarati">{{ $member->education ?: '-' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2.5">
                                    <i class="fa-solid fa-briefcase w-4 text-amber-700 text-center mt-1"></i>
                                    <div>
                                        <span
                                            class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">વ્યવસાય</span>
                                        <span
                                            class="font-semibold text-slate-900 font-gujarati">{{ $member->occupation ?: '-' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2.5 pt-1">
                                    <i class="fa-solid fa-users-line w-4 text-amber-700 text-center mt-1"></i>
                                    <div>
                                        <span
                                            class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider font-gujarati">મોસાળની
                                            અટક</span>
                                        <span
                                            class="font-bold text-amber-800 font-gujarati">{{ $member->maternal_surname ?: '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-8 text-center text-slate-600 border border-slate-200 font-gujarati">
                પરિવારમાં કોઈ સભ્યો ઉમેરાયેલ નથી.
            </div>
        @endif

    </div>
@endsection
