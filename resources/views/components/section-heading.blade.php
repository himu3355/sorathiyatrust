@props(['title', 'subtitle' => null, 'linkUrl' => null, 'linkText' => 'વધુ જુઓ (View All) →'])

<div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 border-b border-slate-200 pb-4 gap-2">
    <div>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-2">
            {{ $title }}
        </h2>
        @if($subtitle)
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 font-gujarati">
                {{ $subtitle }}
            </p>
        @endif
    </div>
    @if($linkUrl)
        <a href="{{ $linkUrl }}" class="text-xs sm:text-sm font-bold text-red-800 hover:text-red-900 transition-colors font-gujarati whitespace-nowrap">
            {{ $linkText }}
        </a>
    @endif
</div>
