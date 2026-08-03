@props(['title', 'subtitle' => null, 'icon' => null])

<div class="gradient-header text-white py-12 px-4 shadow-inner relative overflow-hidden">
    <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto relative z-10">
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-2 font-gujarati flex items-center gap-3">
            @if($icon)
                <i class="{{ $icon }} text-amber-300"></i>
            @endif
            <span>{{ $title }}</span>
        </h1>
        @if($subtitle)
            <p class="text-sm sm:text-base text-amber-100/90 font-medium">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</div>

