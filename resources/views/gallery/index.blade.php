@extends('layouts.app')

@section('title', 'તસવીર અને વીડિયો ગેલેરી - શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')
@section('meta_description', 'શ્રી દશા સોરાઠિયા વણિક સમાજ મહાજન રાજકોટ તસવીર અને વીડિયો ગેલેરી. સમાજના મહોત્સવો, સ્નેહમિલન અને પ્રસંગોની યાદો.')

@section('content')
    <x-page-header icon="fa-solid fa-images" title="તસવીર અને વીડિયો ગેલેરી (Media Gallery)"
        subtitle="સમાજના મહોત્સવો, સ્નેહમિલન અને સાંસ્કૃતિક આયોજનોની યાદો" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{
        modalOpen: false,
        modalType: 'image',
        modalTitle: '',
        modalSrc: '',
        openImage(src, title) {
            this.modalType = 'image';
            this.modalSrc = src;
            this.modalTitle = title;
            this.modalOpen = true;
        },
        openVideo(embedUrl, title) {
            this.modalType = 'video';
            this.modalSrc = embedUrl;
            this.modalTitle = title;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.modalSrc = '';
        }
    }">

        <!-- Filter Tabs & Category Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <!-- Media Type Tabs -->
            <div class="flex items-center gap-2 bg-slate-200/80 p-1.5 rounded-2xl text-xs sm:text-sm font-bold w-full md:w-auto">
                <a href="{{ route('gallery.index', ['type' => 'all', 'category' => $selectedCategory]) }}"
                    class="flex-1 md:flex-initial text-center px-5 py-2.5 rounded-xl transition-all {{ $type === 'all' ? 'bg-amber-600 text-white shadow-xs' : 'text-slate-700 hover:text-slate-900' }}">
                    🖼️ તમામ (All)
                </a>
                <a href="{{ route('gallery.index', ['type' => 'image', 'category' => $selectedCategory]) }}"
                    class="flex-1 md:flex-initial text-center px-5 py-2.5 rounded-xl transition-all {{ $type === 'image' ? 'bg-amber-600 text-white shadow-xs' : 'text-slate-700 hover:text-slate-900' }}">
                    📷 તસવીરો (Photos)
                </a>
                <a href="{{ route('gallery.index', ['type' => 'video', 'category' => $selectedCategory]) }}"
                    class="flex-1 md:flex-initial text-center px-5 py-2.5 rounded-xl transition-all {{ $type === 'video' ? 'bg-amber-600 text-white shadow-xs' : 'text-slate-700 hover:text-slate-900' }}">
                    🎥 વીડિયો (Videos)
                </a>
            </div>

            <!-- Categories Filter -->
            @if ($categories->count() > 0)
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider font-gujarati">કેટેગરી:</span>
                    <a href="{{ route('gallery.index', ['type' => $type, 'category' => 'all']) }}"
                        class="px-3 py-1 rounded-lg text-xs font-bold transition-colors border {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-amber-100 text-amber-900 border-amber-300' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100' }}">
                        બધી
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('gallery.index', ['type' => $type, 'category' => $cat]) }}"
                            class="px-3 py-1 rounded-lg text-xs font-bold transition-colors border {{ $selectedCategory === $cat ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-slate-700 border-slate-200 hover:bg-amber-50 hover:text-amber-800' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Gallery Grid -->
        @if ($items->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($items as $item)
                    <div
                        class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col group relative">

                        <!-- Image Media Item -->
                        @if ($item->type === 'image')
                            <div class="relative overflow-hidden cursor-pointer aspect-4/3 bg-slate-900"
                                @click="openImage('{{ Storage::url($item->image_path) }}', '{{ e($item->title) }}')">
                                @if ($item->image_path)
                                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="w-full h-full gradient-header flex items-center justify-center text-amber-300 font-bold text-lg">
                                        📷 તસવીર
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="w-12 h-12 rounded-full bg-amber-500/90 text-slate-950 flex items-center justify-center text-xl shadow-lg transform group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-expand"></i>
                                    </span>
                                </div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-lg bg-amber-950/80 backdrop-blur-md text-amber-300 text-[10px] font-extrabold border border-amber-400/30">
                                        📷 Photo
                                    </span>
                                </div>
                            </div>
                        @else
                            <!-- Video Media Item -->
                            <div class="relative overflow-hidden cursor-pointer aspect-4/3 bg-slate-900"
                                @click="openVideo('{{ $item->youtube_embed_url }}', '{{ e($item->title) }}')">
                                @if ($item->youtube_thumbnail_url)
                                    <img src="{{ $item->youtube_thumbnail_url }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="w-full h-full bg-slate-950 text-red-500 flex items-center justify-center font-bold text-lg">
                                        🎥 YouTube Video
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-slate-950/30 group-hover:bg-slate-950/50 transition-colors flex items-center justify-center">
                                    <span class="w-14 h-14 rounded-full bg-red-600/90 text-white flex items-center justify-center text-2xl shadow-xl transform group-hover:scale-110 transition-transform border border-white/40">
                                        <i class="fa-solid fa-play ms-1"></i>
                                    </span>
                                </div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-lg bg-red-950/80 backdrop-blur-md text-red-200 text-[10px] font-extrabold border border-red-400/30">
                                        🎥 YouTube
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Card Body -->
                        <div class="p-4 space-y-2 flex-grow">
                            @if ($item->category)
                                <span class="inline-block px-2.5 py-0.5 rounded-md bg-amber-50 text-amber-900 text-[10px] font-extrabold border border-amber-200/60 font-gujarati">
                                    {{ $item->category }}
                                </span>
                            @endif
                            <h3 class="text-sm font-bold text-slate-900 font-gujarati line-clamp-2 leading-snug">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $items->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center text-slate-600 border border-slate-200 shadow-sm space-y-4 font-gujarati">
                <div class="w-16 h-16 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-images"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">કોઈ તસવીર અથવા વીડિયો મળ્યા નથી</h3>
                <p class="text-sm text-slate-600 max-w-md mx-auto">હાલમાં આ શ્રિણીમાં ગેલેરી રેકોર્ડ્સ ઉપલબ્ધ નથી. એડમિન પોર્ટલ પરથી નવી ગેલેરી ઉમેરો.</p>
            </div>
        @endif

        <!-- Lightbox / Video Modal -->
        <div x-show="modalOpen" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
            @keydown.escape.window="closeModal()">
            <div class="relative w-full max-w-4xl bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-amber-500/30 flex flex-col max-h-[90vh]"
                @click.away="closeModal()">
                
                <!-- Modal Header -->
                <div class="p-4 bg-slate-950 border-b border-slate-800 flex justify-between items-center text-white">
                    <h3 class="text-base sm:text-lg font-bold font-gujarati truncate pr-4" x-text="modalTitle"></h3>
                    <button @click="closeModal()" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-2 sm:p-4 flex-grow flex items-center justify-center overflow-auto bg-black min-h-[300px]">
                    <template x-if="modalType === 'image'">
                        <img :src="modalSrc" :alt="modalTitle" class="max-w-full max-h-[70vh] object-contain rounded-xl shadow-lg">
                    </template>
                    <template x-if="modalType === 'video'">
                        <div class="w-full aspect-16/9 rounded-xl overflow-hidden shadow-lg">
                            <iframe :src="modalSrc" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
@endsection
