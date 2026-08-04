@extends('layouts.app')

@section('meta_title', 'વસ્તીપત્રક પરિવાર ડિરેક્ટરી - શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ')
@section('meta_description', 'શ્રી દશા સોરાઠિયા વાણિયા સમાજ મહાજન રાજકોટ વસ્તીપત્રક પરિવાર ડિરેક્ટરી. અટક, ગામ અથવા મુખ્ય સભ્યના નામ પરથી શોધો.')

@section('content')
    <x-page-header icon="fa-solid fa-address-book" title="વસ્તીપત્રક ડિરેક્ટરી (Family Directory)" subtitle="શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ - પરિવારો ની યાદી" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Search Form -->
        <div class="mb-8 p-4 sm:p-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <form action="{{ route('families.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                @if($currentLetter && $currentLetter !== 'all')
                    <input type="hidden" name="letter" value="{{ $currentLetter }}">
                @endif
                <div class="relative w-full flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </div>
                    <input type="text" name="search" value="{{ $searchQuery }}" placeholder="મુખ્ય સભ્યનું નામ, અટક અથવા ગામ થી શોધો (Search by name, surname, village)..." class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-800 bg-slate-50 text-slate-900 placeholder:text-slate-400 font-gujarati text-base shadow-inner">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-2xl transition-all shadow-md flex items-center justify-center gap-2">
                        <i class="fa-solid fa-search"></i>
                        <span>શોધો</span>
                    </button>
                    @if($searchQuery || ($currentLetter && $currentLetter !== 'all'))
                        <a href="{{ route('families.index') }}" class="px-6 py-3.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-2xl transition-colors text-sm flex items-center justify-center">
                            બધા (Reset)
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Gujarati Alphabet Index Navigation -->
        <div class="mb-10 bg-white p-4 sm:p-6 rounded-3xl border border-slate-200 shadow-sm">
            <div class="text-xs font-bold text-slate-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                <i class="fa-solid fa-font text-emerald-800"></i>
                <span>કક્કાવારી મુજબ શોધો (Alphabet Index):</span>
            </div>
            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                <a href="{{ route('families.index', ['letter' => 'all', 'search' => $searchQuery]) }}" 
                   class="px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-bold transition-all border {{ $currentLetter === 'all' ? 'bg-emerald-800 text-white border-emerald-800 shadow-sm' : 'bg-slate-50 text-slate-800 border-slate-200 hover:bg-emerald-800 hover:text-white hover:border-emerald-800' }}">
                    બધા (All)
                </a>
                @foreach($gujaratiLetters as $letter)
                    <a href="{{ route('families.index', ['letter' => $letter]) }}" 
                       class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-bold transition-all border {{ $currentLetter === $letter ? 'bg-emerald-800 text-white border-emerald-800 shadow-sm scale-110' : 'bg-slate-50 text-slate-800 border-slate-200 hover:bg-emerald-800 hover:text-white hover:border-emerald-800' }}">
                        {{ $letter }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Families Results Grid -->
        @if($families->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($families as $family)
                    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col relative group">
                        <!-- Left Accent Bar -->
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-emerald-800"></div>

                        <!-- Card Header -->
                        <div class="p-5 border-b border-slate-100 bg-slate-50/70 flex justify-between items-center pl-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-bold border border-emerald-200">
                                <i class="fa-solid fa-location-dot text-emerald-700"></i>
                                {{ $family->village ?: 'રાજકોટ' }}
                            </span>
                            @if($family->family_code)
                                <span class="text-xs font-semibold text-slate-500">
                                    ID: {{ $family->family_code }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 pl-7 flex-grow space-y-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-800 transition-colors line-clamp-1 font-gujarati">
                                    {{ $family->main_member_name_guj }}
                                </h3>
                                @if($family->main_member_name_eng)
                                    <p class="text-xs text-slate-600 font-medium line-clamp-1 mt-0.5">{{ $family->main_member_name_eng }}</p>
                                @endif
                            </div>

                            <div class="space-y-2.5 text-xs sm:text-sm text-slate-700">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-users w-4 text-emerald-800 text-center"></i>
                                    <span><strong class="text-slate-900">અટક:</strong> {{ $family->surname_guj }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-user-group w-4 text-emerald-800 text-center"></i>
                                    <span><strong class="text-slate-900">કુલ સભ્યો:</strong> {{ $family->active_members_count }}</span>
                                </div>
                                @if($family->address)
                                    <div class="flex items-start gap-2 line-clamp-2">
                                        <i class="fa-solid fa-house w-4 text-emerald-800 text-center mt-1"></i>
                                        <span class="text-slate-600 text-xs leading-relaxed">{{ $family->address }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Action -->
                        <div class="p-4 pl-7 bg-slate-50/80 border-t border-slate-100">
                            <a href="{{ route('families.show', $family->id) }}" class="w-full py-2.5 px-4 bg-white border border-slate-300 hover:bg-emerald-800 hover:text-white text-slate-800 text-xs font-bold rounded-2xl transition-all shadow-xs flex items-center justify-center gap-2 group/btn">
                                <span class="group-hover/btn:text-white">પરિવાર પ્રોફાઈલ જુઓ</span>
                                <i class="fa-solid fa-arrow-right text-xs group-hover/btn:text-white group-hover/btn:translate-x-1 transition-all"></i>
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
            <div class="bg-white rounded-3xl p-12 text-center text-slate-600 border border-slate-200 shadow-sm space-y-4">
                <div class="w-16 h-16 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">કોઈ રેકોર્ડ મળ્યો નથી (No family records found)</h3>
                <p class="text-sm text-slate-600 max-w-md mx-auto">તમારા સર્ચ ફિલ્ટર મુજબ કોઈ પરિવાર મળ્યો નથી. કૃપા કરીને અન્ય અટક અથવા ગામ થી શોધો.</p>
                <a href="{{ route('families.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl transition-colors">
                    બધા રેકોર્ડ્સ જુઓ
                </a>
            </div>
        @endif

    </div>
@endsection
