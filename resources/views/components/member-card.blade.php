@props(['member'])

@php
    $name = $member->member_name_guj ?? $member->gujarati_name ?? $member->name ?? 'સમાજ સભ્ય';
    $subName = $member->member_name_eng ?? $member->english_name ?? null;
    $relation = $member->relation ?? $member->designation ?? 'પરિવાર સભ્ય';
    $mobile = $member->mobile ?? $member->mobile_number ?? null;
    $village = $member->family->village ?? $member->native_village ?? null;
    $profileLink = isset($member->family_id) ? route('families.show', $member->family_id) : '#';
    $initial = $member->initials ?? mb_substr($name, 0, 1);
@endphp

<div class="bg-white rounded-3xl p-5 text-center space-y-3 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-emerald-800 to-teal-800 text-white font-bold text-xl flex items-center justify-center shadow-md">
        {{ $initial }}
    </div>

    <div class="space-y-1">
        <h3 class="text-sm font-bold text-slate-900 font-gujarati line-clamp-1">
            <a href="{{ $profileLink }}" class="hover:text-emerald-800 transition-colors">
                {{ $name }}
            </a>
        </h3>
        @if($subName)
            <p class="text-[11px] text-slate-500 font-medium line-clamp-1">{{ $subName }}</p>
        @endif
        <p class="text-[11px] font-semibold text-emerald-800 font-gujarati bg-emerald-50 rounded-lg py-0.5 px-2 border border-emerald-200/60 inline-block mt-1">
            {{ $relation }} {{ $village ? '('.$village.')' : '' }}
        </p>
    </div>

    @if($mobile)
        <p class="text-xs text-slate-600 font-medium pt-1 flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-phone text-amber-600 text-[10px]"></i>
            <a href="tel:{{ $mobile }}" class="hover:text-emerald-800 transition-colors font-mono">{{ $mobile }}</a>
        </p>
    @endif
</div>
