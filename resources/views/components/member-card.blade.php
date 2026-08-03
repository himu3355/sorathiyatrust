@props(['member'])

<x-card class="text-center p-6 space-y-3">
    <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-4 border-amber-300 shadow-md">
        @if($member->photo_path)
            <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover" loading="lazy">
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
        <h3 class="text-base font-bold text-slate-900 font-gujarati pt-1">
            <a href="{{ route('members.show', $member->id) }}" class="hover:text-emerald-800 transition-colors">
                {{ $member->gujarati_name ?? $member->name }}
            </a>
        </h3>
        @if($member->designation)
            <p class="text-xs font-semibold text-amber-800 font-gujarati bg-amber-50 rounded-lg py-1 px-2 border border-amber-200/60 inline-block">
                {{ $member->designation }}
            </p>
        @endif
    </div>

    @if($member->mobile_number)
        <p class="text-xs text-slate-600 font-medium pt-1 flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-phone text-amber-600"></i>
            <a href="tel:{{ $member->mobile_number }}" class="hover:text-emerald-800 transition-colors">{{ $member->mobile_number }}</a>
        </p>
    @endif
</x-card>
