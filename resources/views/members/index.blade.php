@extends('layouts.app')

@section('title', 'સભ્ય ડિરેક્ટરી - શ્રી દશા સોરાઠિયા વાણિયા સમાજ')

@section('content')
    <x-page-header icon="fa-solid fa-users" title="સમાજ સભ્ય ડિરેક્ટરી (Community Members Directory)" subtitle="સમાજના સભ્યો અને ટ્રસ્ટી આગેવાનોની સત્તાવાર યાદી" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Search & Filter Form -->
        <form action="{{ route('members.index') }}" method="GET" class="mb-8 p-4 bg-white rounded-2xl border border-slate-200 shadow-xs flex flex-col sm:flex-row gap-4 items-center">
            <div class="w-full sm:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="નામ, હોદ્દો અથવા મોબાઇલ નંબર શોધો (Search by name, designation, mobile)..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-800 bg-slate-50 font-gujarati text-sm">
            </div>
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 cursor-pointer">
                    <input type="checkbox" name="committee_only" value="1" {{ request('committee_only') ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-800 focus:ring-emerald-800">
                    <span>ફક્ત ટ્રસ્ટી સમિતિ સભ્યો (Committee Only)</span>
                </label>
            </div>
            <div class="ml-auto flex gap-2 w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-emerald-800 text-white font-bold rounded-xl hover:bg-emerald-900 transition-colors text-sm shadow-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>શોધો</span>
                </button>
                @if(request('search') || request('committee_only'))
                    <a href="{{ route('members.index') }}" class="px-4 py-2.5 bg-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-300 transition-colors text-sm">
                        રીસેટ
                    </a>
                @endif
            </div>
        </form>

        @if($members->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($members as $member)
                    <x-card class="p-6 text-center space-y-4">
                        <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-4 border-amber-300 shadow-md">
                            @if($member->photo_path)
                                <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full gradient-header text-amber-300 font-bold text-2xl flex items-center justify-center">
                                    {{ mb_substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            @if($member->is_committee_member)
                                <x-badge color="amber">ટ્રસ્ટી સભ્ય</x-badge>
                            @endif
                            <h3 class="text-lg font-bold text-slate-900 font-gujarati pt-1">
                                <a href="{{ route('members.show', $member->id) }}" class="hover:text-emerald-800 transition-colors">
                                    {{ $member->gujarati_name ?? $member->name }}
                                </a>
                            </h3>
                            @if($member->name && $member->gujarati_name)
                                <p class="text-xs text-slate-500 font-medium">{{ $member->name }}</p>
                            @endif
                            @if($member->designation)
                                <p class="text-xs font-semibold text-amber-800 font-gujarati bg-amber-50 rounded-lg py-1 px-2 border border-amber-200/60 inline-block">
                                    {{ $member->designation }}
                                </p>
                            @endif
                        </div>
                        @if($member->mobile_number)
                            <div class="pt-2 border-t border-slate-100 text-xs font-medium text-slate-600 flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-phone text-amber-600"></i>
                                <a href="tel:{{ $member->mobile_number }}" class="hover:text-emerald-800 transition-colors">{{ $member->mobile_number }}</a>
                            </div>
                        @endif
                        <div>
                            <a href="{{ route('members.show', $member->id) }}" class="inline-flex items-center justify-center gap-1.5 w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold rounded-xl transition-colors group/btn">
                                <span>પ્રોફાઇલ જુઓ</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $members->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200">
                કોઈ સભ્યો મળ્યા નથી.
            </div>
        @endif
    </div>
@endsection
