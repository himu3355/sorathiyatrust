@extends('layouts.app')

@section('title', 'શ્રી મહાપ્રભુજીના ૮૪ બેઠકજીના સરનામાં તેમજ ટેલિફોન નંબર - શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')
@section('meta_description', 'શ્રી મહાપ્રભુજીના ૮૪ બેઠકજીના સંપૂર્ણ સરનામાં, ટેલિફોન નંબર અને મુખ્યજીઓની માહિતી.')

@section('content')
    <x-page-header icon="fa-solid fa-building-columns" title="શ્રી મહાપ્રભુજીના ૮૪ બેઠકજીના સરનામાં"
        subtitle="શ્રી મહાપ્રભુજીના ૮૪ બેઠકજીના સરનામાં તેમજ ટેલિફોન અને મોબાઇલ નંબર ની સંપૂર્ણ યાદી" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Search Form -->
        <div class="mb-8 p-4 sm:p-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <form action="{{ route('baithak.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                <div class="relative w-full flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </div>
                    <input type="text" name="search" value="{{ $searchQuery }}"
                        placeholder="બેઠક નંબર, ગામનું નામ અથવા સરનામું થી શોધો (Search by Baithak No., Village, Address)..."
                        class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-600 bg-slate-50 text-slate-900 placeholder:text-slate-400 font-gujarati text-base shadow-inner">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-2xl transition-all shadow-md flex items-center justify-center gap-2 font-gujarati">
                        <i class="fa-solid fa-search"></i>
                        <span>શોધો</span>
                    </button>
                    @if ($searchQuery)
                        <a href="{{ route('baithak.index') }}"
                            class="px-6 py-3.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-2xl transition-colors text-sm flex items-center justify-center font-gujarati">
                            બધા (Reset)
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- 84 Baithakji List Table/Card Grid -->
        @if ($baithaks->count() > 0)
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="gradient-header text-white text-xs sm:text-sm font-gujarati">
                                <th class="py-4 px-4 text-center font-bold w-16 border-b border-amber-500/30">નં.</th>
                                <th class="py-4 px-4 font-bold w-36 sm:w-48 border-b border-amber-500/30">ગામનું નામ</th>
                                <th class="py-4 px-6 font-bold border-b border-amber-500/30">શ્રી બેઠકજીના સરનામા</th>
                                <th class="py-4 px-6 font-bold w-56 sm:w-72 border-b border-amber-500/30">ટેલિફોન-મોબાઇલ નં. / મુખ્યજી</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs sm:text-sm font-gujarati">
                            @foreach ($baithaks as $b)
                                <tr class="hover:bg-amber-50/40 transition-colors {{ $b->is_apragat ? 'bg-slate-50/60' : '' }}">
                                    <!-- Baithak Number -->
                                    <td class="py-4 px-4 text-center align-top font-bold">
                                        <span class="w-9 h-9 rounded-2xl {{ $b->is_apragat ? 'bg-slate-200 text-slate-700' : 'bg-amber-600 text-white shadow-xs' }} font-bold inline-flex items-center justify-center font-mono">
                                            {{ $b->number }}
                                        </span>
                                    </td>

                                    <!-- Village Name -->
                                    <td class="py-4 px-4 align-top font-bold text-slate-900 leading-snug">
                                        <div class="text-sm sm:text-base text-amber-900">{{ $b->city_village_guj }}</div>
                                        @if ($b->is_apragat)
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded-md bg-slate-200 text-slate-700 text-[10px] font-bold">
                                                અપ્રગટ બેઠક
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Address -->
                                    <td class="py-4 px-6 align-top text-slate-800 leading-relaxed">
                                        {!! nl2br(e($b->address_guj)) !!}
                                    </td>

                                    <!-- Contact Info & Mukhyaji -->
                                    <td class="py-4 px-6 align-top space-y-1.5">
                                        @if ($b->contact_person_guj)
                                            <div class="font-bold text-slate-900 flex items-center gap-1.5 text-xs sm:text-sm">
                                                <i class="fa-solid fa-user text-amber-600 text-xs"></i>
                                                <span>{{ $b->contact_person_guj }}</span>
                                            </div>
                                        @endif

                                        @if ($b->contact_numbers)
                                            <div class="font-mono text-slate-700 font-semibold flex items-start gap-1.5 text-xs">
                                                <i class="fa-solid fa-phone text-amber-600 text-xs mt-0.5"></i>
                                                <span class="leading-relaxed">{{ $b->contact_numbers }}</span>
                                            </div>
                                        @endif

                                        @if (!$b->contact_person_guj && !$b->contact_numbers && $b->is_apragat)
                                            <span class="text-slate-400 text-xs italic">અપ્રગટ (વિગત ઉપલબ્ધ નથી)</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $baithaks->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center text-slate-600 border border-slate-200 shadow-sm space-y-4 font-gujarati">
                <div class="w-16 h-16 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">કોઈ બેઠકજી મળી નથી (No Baithakji record found)</h3>
                <p class="text-sm text-slate-600 max-w-md mx-auto">તમારા સર્ચ ફિલ્ટર મુજબ કોઈ બેઠકજી મળી નથી.</p>
                <a href="{{ route('baithak.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl transition-colors">
                    બધા ૮૪ બેઠકજી જુઓ
                </a>
            </div>
        @endif

    </div>
@endsection
