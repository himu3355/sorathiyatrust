@extends('layouts.app')

@section('title', 'અમારા વિશે - શ્રી દશા સોરાઠિયા વાણિયા સમાજ')

@section('content')
    <x-page-header icon="fa-solid fa-landmark" title="અમારા વિશે (About Trust)" subtitle="શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
        <!-- History & Mission -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                <i class="fa-solid fa-landmark text-amber-600"></i>
                <span>ટ્રસ્ટનો ઇતિહાસ અને ઉદ્દેશ્યો (History & Objectives)</span>
            </h2>
            <p class="text-base text-slate-700 leading-relaxed font-gujarati">
                શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ એ સમાજના બંધુઓના શૈક્ષણિક, સામાજિક, સાંસ્કૃતિક અને આર્થિક ઉત્કર્ષ અર્થે કાર્યરત એક અગ્રણી અને પ્રતિષ્ઠિત ટ્રસ્ટ છે.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                <div class="p-6 bg-amber-50 rounded-2xl border border-amber-200/60 space-y-2">
                    <h3 class="text-lg font-bold text-amber-900 font-gujarati flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-amber-700"></i>
                        <span>શિક્ષણ સહાય</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-gujarati">સમાજના તેજસ્વી અને જરુરિયાતમંદ વિદ્યાર્થીઓને શિષ્યવૃત્તિ અને પ્રોત્સાહન ઇનામો.</p>
                </div>
                <div class="p-6 bg-teal-50 rounded-2xl border border-teal-200/60 space-y-2">
                    <h3 class="text-lg font-bold text-teal-900 font-gujarati flex items-center gap-2">
                        <i class="fa-solid fa-handshake text-teal-700"></i>
                        <span>સામાજિક સંગઠન</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-gujarati">વાર્ષિક મહોત્સવ, રક્તદાન શિબિર અને કૌટુંબિક સ્નેહમિલન આયોજન.</p>
                </div>
                <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-200/60 space-y-2">
                    <h3 class="text-lg font-bold text-emerald-900 font-gujarati flex items-center gap-2">
                        <i class="fa-solid fa-address-card text-emerald-700"></i>
                        <span>વસ્તીપત્રક અને માહિતી</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-gujarati">સમાજના તમામ પરિવારોનું સચોટ ડિજિટલ વસ્તીપત્રક અને સંપર્ક સંગ્રહ.</p>
                </div>
            </div>
        </div>

        <!-- Committee Members Section -->
        @if($trustees->count() > 0)
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 font-gujarati mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-users-gear text-amber-600"></i>
                    <span>ટ્રસ્ટી મંડળ અને આગેવાનો (Board of Trustees)</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($trustees as $trustee)
                        <div class="bg-white rounded-3xl p-6 text-center space-y-3 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-emerald-800 to-teal-800 text-white font-bold text-xl flex items-center justify-center shadow-md">
                                {{ $trustee->initials }}
                            </div>
                            <h3 class="text-base font-bold text-slate-900 font-gujarati">
                                {{ $trustee->member_name_guj }}
                            </h3>
                            <p class="text-xs font-semibold text-emerald-800 font-gujarati">
                                {{ $trustee->relation ?: 'ટ્રસ્ટી/આગેવાન' }} ({{ $trustee->family->village ?? 'રાજકોટ' }})
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
