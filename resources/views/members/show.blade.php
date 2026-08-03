@extends('layouts.app')

@section('meta_title', ($member->gujarati_name ?? $member->name) . ' - સભ્ય પ્રોફાઇલ')
@section('meta_description', ($member->gujarati_name ?? $member->name) . ($member->designation ? ' - ' . $member->designation : '') . ' - શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ.')
@if($member->photo_path)
    @section('og_image', Storage::url($member->photo_path))
@endif

@section('content')
    <x-page-header icon="fa-solid fa-user" :title="$member->gujarati_name ?? $member->name" :subtitle="$member->designation ?? 'સમાજ સભ્ય'" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-amber-300 shadow-lg flex-shrink-0">
                    @if($member->photo_path)
                        <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full gradient-header text-amber-300 font-bold text-4xl flex items-center justify-center">
                            {{ mb_substr($member->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <div class="space-y-2 text-center sm:text-left">
                    @if($member->is_committee_member)
                        <x-badge color="amber">ટ્રસ્ટી સમિતિ સભ્ય (Trustee Committee)</x-badge>
                    @endif
                    <h2 class="text-2xl font-extrabold text-slate-900 font-gujarati">
                        {{ $member->gujarati_name ?? $member->name }}
                    </h2>
                    @if($member->name && $member->gujarati_name)
                        <p class="text-sm text-slate-500 font-medium">{{ $member->name }}</p>
                    @endif
                    @if($member->designation)
                        <p class="text-sm font-semibold text-amber-800 font-gujarati">
                            {{ $member->designation }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Member Details Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                @if($member->mobile_number)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-xs text-slate-500 font-medium block mb-1">મોબાઇલ નંબર (Mobile)</span>
                        <span class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-phone text-amber-600"></i>
                            <a href="tel:{{ $member->mobile_number }}" class="hover:text-emerald-800 transition-colors">{{ $member->mobile_number }}</a>
                        </span>
                    </div>
                @endif

                @if($member->membership_number)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-xs text-slate-500 font-medium block mb-1">સભ્ય ક્રમાંક (Membership No)</span>
                        <span class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-amber-600"></i>
                            <span>{{ $member->membership_number }}</span>
                        </span>
                    </div>
                @endif

                @if($member->email)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-xs text-slate-500 font-medium block mb-1">ઇમેઇલ (Email)</span>
                        <span class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-600"></i>
                            <span>{{ $member->email }}</span>
                        </span>
                    </div>
                @endif

                @if($member->address)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 sm:col-span-2 font-gujarati">
                        <span class="text-xs text-slate-500 font-medium block mb-1">સરનામું (Address)</span>
                        <span class="text-base font-semibold text-slate-900 flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-amber-600 mt-1"></i>
                            <span>{{ $member->address }}</span>
                        </span>
                    </div>
                @endif
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-between items-center">
                <a href="{{ route('members.index') }}" class="text-sm font-bold text-emerald-800 hover:text-emerald-900 flex items-center gap-2 group/back">
                    <i class="fa-solid fa-arrow-left text-xs group-hover/back:-translate-x-1 transition-transform"></i>
                    <span>પાછા જાઓ (Back to Members)</span>
                </a>
            </div>
        </div>
    </div>
@endsection
