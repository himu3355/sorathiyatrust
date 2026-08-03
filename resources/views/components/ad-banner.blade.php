@props(['ad' => null, 'position' => null])

@php
    if (!$ad && $position) {
        $ad = \App\Models\Advertisement::activePosition($position)->first();
    }
@endphp

@if($ad)
    <div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8']) }}>
        <a href="{{ $ad->link_url ?? '#' }}" class="block rounded-2xl overflow-hidden shadow-md border border-amber-200/80 hover:opacity-95 transition-all duration-300 hover:scale-[1.005]" target="{{ $ad->link_url ? '_blank' : '_self' }}" rel="noopener">
            @if($ad->image_path)
                <img src="{{ Storage::url($ad->image_path) }}" alt="{{ $ad->title }}" class="w-full h-auto max-h-40 object-cover" loading="lazy">
            @else
                <div class="w-full p-4 bg-gradient-to-r from-amber-50 via-amber-100 to-amber-50 text-amber-900 text-center font-bold text-sm sm:text-base border border-amber-300/80 font-gujarati shadow-inner">
                    📣 {{ $ad->title }}
                </div>
            @endif
        </a>
    </div>
@endif
