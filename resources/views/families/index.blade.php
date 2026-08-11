@extends('layouts.app')

@section('title', 'વસ્તીપત્રક પરિવાર ડિરેક્ટરી - શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')
@section('meta_description',
    'શ્રી દશા સોરાઠિયા વણિક સમાજ મહાજન રાજકોટ વસ્તીપત્રક પરિવાર ડિરેક્ટરી. અટક, ગામ અથવા મુખ્ય
    સભ્યના નામ પરથી શોધો.')

@section('content')
    <x-page-header icon="fa-solid fa-address-book" title="વસ્તીપત્રક ડિરેક્ટરી (Family Directory)"
        subtitle="શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - પરિવારો ની યાદી" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Search Form -->
        <div class="mb-8 p-4 sm:p-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <form action="{{ route('families.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                @if ($currentLetter && $currentLetter !== 'all')
                    <input type="hidden" name="letter" value="{{ $currentLetter }}">
                @endif
                <input type="hidden" name="filter_type" value="{{ $filterType }}">

                <div class="relative w-full flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </div>
                    <input type="text" name="search" value="{{ $searchQuery }}"
                        placeholder="મુખ્ય સભ્યનું નામ, અટક અથવા ગામ થી શોધો (Search by name, surname, village)..."
                        class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-600 bg-slate-50 text-slate-900 placeholder:text-slate-400 font-gujarati text-base shadow-inner">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-2xl transition-all shadow-md flex items-center justify-center gap-2 font-gujarati">
                        <i class="fa-solid fa-search"></i>
                        <span>શોધો</span>
                    </button>
                    @if ($searchQuery || ($currentLetter && $currentLetter !== 'all'))
                        <a href="{{ route('families.index') }}"
                            class="px-6 py-3.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-2xl transition-colors text-sm flex items-center justify-center font-gujarati">
                            બધા (Reset)
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Gujarati Alphabet Index Navigation with Filter Toggle Switch Button -->
        <div class="mb-10 bg-white p-4 sm:p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-extrabold text-slate-800 tracking-wider flex items-center gap-2 font-gujarati">
                    <i class="fa-solid fa-font text-amber-600"></i>
                    <span>કક્કાવારી શોધો (Alphabet Filter):</span>
                </div>

                <!-- Single Toggle Switch Button (Name vs Surname) -->
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold font-gujarati text-slate-500">શોધ પ્રકાર:</span>
                    <a href="{{ route('families.index', ['letter' => $currentLetter, 'filter_type' => $filterType === 'surname' ? 'name' : 'surname', 'search' => $searchQuery]) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-extrabold transition-all shadow-xs border font-gujarati group {{ $filterType === 'surname' ? 'bg-slate-900 text-amber-300 border-slate-800 hover:bg-slate-800' : 'bg-amber-100 text-amber-950 border-amber-300 hover:bg-amber-200' }}"
                        title="ક્લિક કરીને સભ્ય નામ અથવા અટક વચ્ચે ફિલ્ટર બદલો">
                        <i class="fa-solid {{ $filterType === 'surname' ? 'fa-id-card text-amber-400' : 'fa-user text-amber-700' }}"></i>
                        <span>{{ $filterType === 'surname' ? 'અટક પરથી (By Surname)' : 'મુખ્ય સભ્યના નામ પરથી (By Name)' }}</span>
                        <span class="px-2 py-0.5 rounded-lg bg-white/30 text-[10px] uppercase font-mono tracking-wider text-slate-900 group-hover:scale-105 transition-transform">
                            {{ $filterType === 'surname' ? 'બદલો → નામ' : 'બદલો → અટક' }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Alphabet Letters Buttons Bar -->
            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                <a href="{{ route('families.index', ['letter' => 'all', 'filter_type' => $filterType, 'search' => $searchQuery]) }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-bold transition-all border {{ $currentLetter === 'all' ? 'bg-amber-600 text-white border-amber-600 shadow-sm' : 'bg-slate-50 text-slate-800 border-slate-200 hover:bg-amber-600 hover:text-white hover:border-amber-600' }}">
                    બધા (All)
                </a>
                @foreach ($gujaratiLetters as $letter)
                    <a href="{{ route('families.index', ['letter' => $letter, 'filter_type' => $filterType, 'search' => $searchQuery]) }}"
                        class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-bold transition-all border {{ $currentLetter === $letter ? 'bg-amber-600 text-white border-amber-600 shadow-sm scale-110' : 'bg-slate-50 text-slate-800 border-slate-200 hover:bg-amber-600 hover:text-white hover:border-amber-600' }}">
                        {{ $letter }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Families Results Grid -->
        @if ($families->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($families as $family)
                    <div
                        class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col relative group">
                        <!-- Left Accent Bar -->
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-600"></div>

                        <!-- Card Header (Surnames Bigger & Bold, Family Code Moved to Body) -->
                        <div class="p-5 border-b border-slate-100 bg-amber-50/40 flex items-center pl-6">
                            <span
                                class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-2xl bg-amber-600 text-white text-base sm:text-lg font-extrabold font-gujarati shadow-2xs">
                                {{ $family->surname_guj ?: 'પરિવાર' }}
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 pl-7 flex-grow space-y-4">
                            <div>
                                <h3
                                    class="text-lg font-bold text-slate-900 group-hover:text-amber-700 transition-colors line-clamp-1 font-gujarati leading-tight">
                                    {{ $family->main_member_name_guj }}
                                </h3>
                                @if ($family->main_member_name_eng)
                                    <p class="text-xs text-slate-500 font-medium line-clamp-1 mt-0.5">
                                        {{ $family->main_member_name_eng }}</p>
                                @endif
                            </div>

                            <div class="space-y-2.5 text-xs sm:text-sm text-slate-700">
                                @if ($family->family_code)
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-id-card w-4 text-amber-600 text-center"></i>
                                        <span><strong class="text-slate-900">સભ્ય ક્રમાંક:</strong> <span class="font-mono font-bold text-amber-900">{{ $family->family_code }}</span></span>
                                    </div>
                                @endif
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot w-4 text-amber-600 text-center"></i>
                                    <span><strong class="text-slate-900">ગામ:</strong> {{ $family->village }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-users w-4 text-amber-600 text-center"></i>
                                    <span><strong class="text-slate-900">કુલ સભ્યો:</strong>
                                        {{ $family->active_members_count }}</span>
                                </div>
                                @if ($family->address)
                                    <div class="flex items-start gap-2 line-clamp-2">
                                        <i class="fa-solid fa-house w-4 text-amber-600 text-center mt-1"></i>
                                        <span class="text-slate-600 text-xs leading-relaxed">{{ $family->address }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Action -->
                        <div class="p-4 pl-7 bg-slate-50/80 border-t border-slate-100">
                            <a href="{{ route('families.show', $family->id) }}"
                                class="w-full py-2.5 px-4 bg-white border border-slate-300 hover:bg-amber-600 hover:border-amber-600 text-slate-800 hover:text-white text-xs font-bold rounded-2xl transition-all shadow-xs flex items-center justify-center gap-2 group/btn font-gujarati">
                                <span>પરિવાર પ્રોફાઈલ જુઓ</span>
                                <i
                                    class="fa-solid fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-all"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $families->links() }}
            </div>
        @else
            <div
                class="bg-white rounded-3xl p-12 text-center text-slate-600 border border-slate-200 shadow-sm space-y-4 font-gujarati">
                <div
                    class="w-16 h-16 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">કોઈ રેકોર્ડ મળ્યો નથી (No family records found)</h3>
                <p class="text-sm text-slate-600 max-w-md mx-auto">તમારા સર્ચ ફિલ્ટર મુજબ કોઈ પરિવાર મળ્યો નથી. કૃપા કરીને
                    અન્ય અટક અથવા ગામ થી શોધો.</p>
                <a href="{{ route('families.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl transition-colors">
                    બધા રેકોર્ડ્સ જુઓ
                </a>
            </div>
        @endif

    </div>
@endsection
