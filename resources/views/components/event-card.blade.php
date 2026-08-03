@props(['event'])

<x-card>
    <div class="relative overflow-hidden group">
        @if($event->image_path)
            <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        @else
            <div class="w-full h-48 bg-slate-800 text-amber-300 flex items-center justify-center font-bold text-lg">
                કાર્યક્રમ
            </div>
        @endif
        <div class="absolute top-3 left-3">
            <x-badge :color="$event->event_date >= now() ? 'emerald' : 'slate'">
                {{ $event->event_date >= now() ? 'આગામી (Upcoming)' : 'ગત (Past)' }}
            </x-badge>
        </div>
    </div>

    <div class="p-5 space-y-3">
        <h3 class="text-base sm:text-lg font-bold text-slate-900 font-gujarati line-clamp-2 hover:text-emerald-800 transition-colors">
            <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
        </h3>

        <div class="space-y-1.5 text-xs text-slate-600 font-medium">
            <p class="flex items-center gap-2 font-gujarati">
                <i class="fa-regular fa-calendar-days text-amber-600 text-sm"></i>
                <span class="font-bold text-slate-800">{{ $event->event_date->format('d M Y - h:i A') }}</span>
            </p>
            @if($event->location)
                <p class="flex items-center gap-2 font-gujarati">
                    <i class="fa-solid fa-location-dot text-amber-600 text-sm"></i>
                    <span>{{ $event->location }}</span>
                </p>
            @endif
        </div>

        <div class="pt-2">
            <a href="{{ route('events.show', $event->slug) }}" class="text-xs font-bold text-emerald-800 hover:text-emerald-900 inline-flex items-center gap-1.5 font-gujarati group/link">
                <span>કાર્યક્રમ વિગત</span>
                <i class="fa-solid fa-arrow-right text-[11px] group-hover/link:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</x-card>
