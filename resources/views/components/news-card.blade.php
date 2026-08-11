@props(['news'])

<x-card>
    <div class="relative overflow-hidden group">
        @if($news->image_path)
            <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        @else
            <div class="w-full h-48 gradient-header flex items-center justify-center text-white font-bold text-lg">
                સમાચાર
            </div>
        @endif
        @if($news->is_featured)
            <div class="absolute top-3 left-3">
                <x-badge color="amber">વિશેષ (Featured)</x-badge>
            </div>
        @endif
    </div>

    <div class="p-5 space-y-3">
        <div class="text-xs text-slate-500 font-semibold flex items-center gap-1.5">
            <i class="fa-regular fa-clock text-amber-600"></i>
            <span>{{ $news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y') }}</span>
        </div>

        <h3 class="text-base sm:text-lg font-bold text-slate-900 font-gujarati line-clamp-2 hover:text-amber-700 transition-colors">
            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
        </h3>

        @if($news->summary)
            <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 font-gujarati">
                {{ $news->summary }}
            </p>
        @endif

        <div class="pt-2">
            <a href="{{ route('news.show', $news->slug) }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 inline-flex items-center gap-1.5 font-gujarati group/link">
                <span>સંપૂર્ણ વિગત વાંચો</span>
                <i class="fa-solid fa-arrow-right text-[11px] group-hover/link:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</x-card>
