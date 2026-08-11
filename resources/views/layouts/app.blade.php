<!DOCTYPE html>
<html lang="gu" dir="ltr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/sorathiya-trust-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sorathiya-trust-logo.png') }}">

    <!-- Primary Meta Tags -->
    <title>@yield('meta_title', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - Community Trust')</title>
    <meta name="description" content="@yield('meta_description', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - સત્તાવાર ડિજિટલ પોર્ટલ, સભ્ય ડિરેક્ટરી અને સમાચાર.')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Open Graph / Facebook / WhatsApp Meta Tags -->
    <meta property="og:site_name" content="શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:title" content="@yield('meta_title', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')">
    <meta property="og:description" content="@yield('meta_description', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - સત્તાવાર ડિજિટલ પોર્ટલ, સભ્ય ડિરેક્ટરી અને સમાચાર.')">
    <meta property="og:image" content="@yield('og_image', asset('images/sorathiya-trust-logo.png'))">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('canonical_url', url()->current())">
    <meta name="twitter:title" content="@yield('meta_title', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ')">
    <meta name="twitter:description" content="@yield('meta_description', 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - સત્તાવાર ડિજિટલ પોર્ટલ.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/sorathiya-trust-logo.png'))">

    <!-- Vite CSS / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome 6 Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="bg-slate-50 text-slate-800 flex flex-col min-h-screen font-sans antialiased selection:bg-amber-500 selection:text-white">

    <!-- Top Announcement / Bar -->
    <div class="gradient-header text-white text-xs sm:text-sm py-2 px-4 shadow-xs border-b border-amber-400/30">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2 font-medium">
                <span class="inline-block w-2 h-2 rounded-full bg-amber-300 animate-pulse"></span>
                <span>શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ</span>
            </div>
            <div class="flex items-center gap-4 text-amber-100 font-medium">
                @if ($phone = \App\Models\SiteSetting::get('phone_number', '+91 98765 43210'))
                    <a href="tel:{{ str_replace(' ', '', $phone) }}" class="flex items-center gap-1.5 hover:text-white transition-colors">
                        <i class="fa-solid fa-phone-volume text-amber-300"></i>
                        <span>{{ $phone }}</span>
                    </a>
                @endif
                <span class="hidden md:inline text-amber-400/40">|</span>
                <a href="{{ route('contact') }}"
                    class="flex items-center gap-1.5 hover:text-amber-300 transition-colors">
                    <i class="fa-solid fa-paper-plane text-amber-300"></i>
                    <span>સંપર્ક કરો</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 glass-nav border-b border-slate-200/80 shadow-xs" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20 lg:h-28 py-2">
                <!-- Header Logo & Brand Title Link -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3.5 group py-1"
                    title="શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ">
                    <div
                        class="w-11 h-11 sm:w-16 sm:h-16 lg:w-24 lg:h-24 rounded-xl lg:rounded-2xl bg-amber-600 p-1 lg:p-2 shadow-md border border-amber-500/60 flex items-center justify-center group-hover:scale-105 transition-transform trust-badge-glow flex-shrink-0">
                        <img src="{{ asset('images/sorathiya-trust-logo.png') }}"
                            alt="શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ" class="w-full h-full object-contain">
                    </div>
                    <!-- Brand Title Text: Visible ONLY on Mobile/Tablet (Hidden on Desktop lg:hidden) -->
                    <div class="block lg:hidden">
                        <span
                            class="block text-sm sm:text-base font-bold text-slate-900 leading-tight group-hover:text-amber-700 transition-colors">
                            દશા સોરાઠિયા વણિક સમાજ
                        </span>
                        <span class="block text-[10px] sm:text-xs font-semibold text-amber-700 tracking-wider">
                            મહાજન, રાજકોટ (ટ્રસ્ટ)
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden lg:flex items-center gap-1 font-medium text-slate-700">
                    <a href="{{ route('home') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-house text-xs {{ request()->routeIs('home') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>મુખ્ય પૃષ્ઠ</span>
                    </a>
                    <a href="{{ route('committee.index') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('committee.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-user-tie text-xs {{ request()->routeIs('committee.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>હોદ્દેદારો અને કારોબારી</span>
                    </a>
                    <a href="{{ route('baithak.index') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('baithak.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-building-columns text-xs {{ request()->routeIs('baithak.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>૮૪ બેઠકજી</span>
                    </a>
                    <a href="{{ route('news.index') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('news.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-newspaper text-xs {{ request()->routeIs('news.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>સમાચાર</span>
                    </a>
                    <a href="{{ route('events.upcoming') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('events.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-calendar-days text-xs {{ request()->routeIs('events.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>કાર્યક્રમો</span>
                    </a>
                    <a href="{{ route('gallery.index') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('gallery.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-images text-xs {{ request()->routeIs('gallery.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>ગેલેરી</span>
                    </a>
                    <a href="{{ route('members.index') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('members.*') || request()->routeIs('families.*') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-address-book text-xs {{ request()->routeIs('members.*') || request()->routeIs('families.*') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>વસ્તીપત્રક ડિરેક્ટરી</span>
                    </a>
                    <a href="{{ route('about') }}"
                        class="px-3.5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 {{ request()->routeIs('about') ? 'bg-amber-600 text-white shadow-xs font-semibold' : 'hover:bg-amber-50 hover:text-amber-800' }}">
                        <i
                            class="fa-solid fa-circle-info text-xs {{ request()->routeIs('about') ? 'text-amber-200' : 'text-slate-400' }}"></i>
                        <span>અમારા વિશે</span>
                    </a>
                </nav>

                <!-- Admin Link & Mobile Menu Toggle -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/admin') }}"
                        class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-amber-100 bg-[#4A0000] hover:bg-[#8B0000] border border-amber-500/60 rounded-xl transition-all shadow-xs hover:scale-105">
                        <i class="fa-solid fa-user-shield text-amber-300"></i>
                        <span>એડમિન પોર્ટલ</span>
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden p-2.5 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-amber-600 transition-colors"
                        aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" x-cloak
            class="lg:hidden bg-white/95 backdrop-blur-lg border-b border-slate-200 px-4 pt-2 pb-6 space-y-2 shadow-xl">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>મુખ્ય પૃષ્ઠ (Home)</span>
            </a>
            <a href="{{ route('committee.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('committee.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-user-tie w-5 text-center"></i>
                <span>હોદ્દેદારો અને કારોબારી (Committee)</span>
            </a>
            <a href="{{ route('baithak.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('baithak.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-building-columns w-5 text-center"></i>
                <span>૮૪ બેઠકજી (84 Baithakji)</span>
            </a>
            <a href="{{ route('news.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('news.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-newspaper w-5 text-center"></i>
                <span>સમાચાર (News)</span>
            </a>
            <a href="{{ route('events.upcoming') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('events.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-calendar-days w-5 text-center"></i>
                <span>કાર્યક્રમો (Events)</span>
            </a>
            <a href="{{ route('gallery.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('gallery.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-images w-5 text-center"></i>
                <span>ગેલેરી (Gallery)</span>
            </a>
            <a href="{{ route('members.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('members.*') || request()->routeIs('families.*') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-address-book w-5 text-center"></i>
                <span>વસ્તીપત્રક ડિરેક્ટરી (Directory)</span>
            </a>
            <a href="{{ route('about') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('about') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-circle-info w-5 text-center"></i>
                <span>અમારા વિશે (About)</span>
            </a>
            <a href="{{ route('contact') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('contact') ? 'bg-amber-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-envelope w-5 text-center"></i>
                <span>સંપર્ક (Contact)</span>
            </a>
            <a href="{{ url('/admin') }}"
                class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-base font-bold bg-[#4A0000] text-amber-200 border border-amber-500/60 text-center shadow-xs">
                <i class="fa-solid fa-user-shield"></i>
                <span>એડમિન પોર્ટલ (Admin Login)</span>
            </a>
        </div>
    </header>

    <!-- Global Flash Notification -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div
                class="bg-amber-50 border-l-4 border-amber-500 text-amber-900 p-4 rounded-2xl shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-amber-600 text-xl"></i>
                    <p class="font-medium text-sm sm:text-base">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-300 pt-16 pb-8 border-t-4 border-amber-500 mt-20 relative overflow-hidden">
        <!-- Subtle Glow Effect -->
        <div
            class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Trust Overview -->
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-amber-600 p-1.5 shadow-md border border-amber-400/40 flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/sorathiya-trust-logo.png') }}" alt="દશા સોરાઠિયા વણિક સમાજ" class="w-full h-full object-contain">
                        </div>
                        <h3 class="text-lg font-bold text-white leading-tight">
                            દશા સોરાઠિયા વણિક સમાજ
                        </h3>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed font-gujarati">
                        શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ. સમાજ કલ્યાણ, શિક્ષણ, સંસ્કૃતિ અને વિકાસ અર્થે
                        સમર્પિત ટ્રસ્ટ.
                    </p>
                    <!-- Social Media Links -->
                    <div class="flex items-center gap-3 pt-2">
                        @if ($waNumber = \App\Models\SiteSetting::get('whatsapp_number'))
                            <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                                class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-amber-400 hover:bg-amber-600 hover:text-white hover:border-amber-500 transition-all"
                                title="WhatsApp">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                        @endif
                        @if ($fbUrl = \App\Models\SiteSetting::get('facebook_url'))
                            <a href="{{ $fbUrl }}" target="_blank"
                                class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all"
                                title="Facebook">
                                <i class="fa-brands fa-facebook-f text-base"></i>
                            </a>
                        @endif
                        @if ($ytUrl = \App\Models\SiteSetting::get('youtube_url'))
                            <a href="{{ $ytUrl }}" target="_blank"
                                class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all"
                                title="YouTube">
                                <i class="fa-brands fa-youtube text-base"></i>
                            </a>
                        @endif
                        @if ($instaUrl = \App\Models\SiteSetting::get('instagram_url'))
                            <a href="{{ $instaUrl }}" target="_blank"
                                class="w-9 h-9 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-pink-500 hover:bg-pink-600 hover:text-white hover:border-pink-500 transition-all"
                                title="Instagram">
                                <i class="fa-brands fa-instagram text-base"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Navigation Links -->
                <div>
                    <h4 class="text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-4">ઝડપી લિંક્સ (Quick
                        Links)</h4>
                    <ul class="space-y-2.5 text-sm font-medium">
                        <li><a href="{{ route('home') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> મુખ્ય પૃષ્ઠ
                                (Home)</a></li>
                        <li><a href="{{ route('committee.index') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> હોદ્દેદારો અને કારોબારી સભ્યો</a></li>
                        <li><a href="{{ route('baithak.index') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> શ્રી મહાપ્રભુજીના ૮૪ બેઠકજી</a></li>
                        <li><a href="{{ route('gallery.index') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> તસવીર અને વીડિયો ગેલેરી</a></li>
                        <li><a href="{{ route('news.index') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> સમાચાર અને
                                અપડેટ્સ</a></li>
                    </ul>
                </div>

                <!-- Directory & Trust Info Links -->
                <div>
                    <h4 class="text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-4">વસ્તીપત્રક અને માહિતી
                    </h4>
                    <ul class="space-y-2.5 text-sm font-medium">
                        <li><a href="{{ route('members.index') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> વસ્તીપત્રક
                                ડિરેક્ટરી</a></li>
                        <li><a href="{{ route('about') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> ટ્રસ્ટ વિશે અને
                                સમિતિ</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="hover:text-amber-300 transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-[10px] text-amber-500"></i> સંપર્ક વિગત અને
                                નકશો</a></li>
                        <li><a href="{{ url('/admin') }}"
                                class="hover:text-amber-300 transition-colors text-amber-400 font-bold flex items-center gap-2"><i
                                    class="fa-solid fa-user-shield text-xs"></i> એડમિન પેનલ</a></li>
                    </ul>
                </div>

                <!-- Contact Summary -->
                <div class="space-y-3 text-sm">
                    <h4 class="text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-4">ટ્રસ્ટ સંપર્ક
                        (Contact)</h4>
                    @if ($officeAddr = \App\Models\SiteSetting::get('office_address', 'મહાજન વાડી, રાજકોટ, ગુજરાત.'))
                        <p class="text-slate-400 text-xs sm:text-sm flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-amber-400 mt-1"></i>
                            <span>{{ $officeAddr }}</span>
                        </p>
                    @endif
                    @if ($phone = \App\Models\SiteSetting::get('phone_number', '+91 98765 43210'))
                        <p class="text-slate-400 text-xs sm:text-sm flex items-center gap-2.5">
                            <i class="fa-solid fa-phone-volume text-amber-400"></i>
                            <span>{{ $phone }}</span>
                        </p>
                    @endif
                    @if ($email = \App\Models\SiteSetting::get('contact_email', 'info@trustwebsite.org'))
                        <p class="text-slate-400 text-xs sm:text-sm flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-amber-400"></i>
                            <span>{{ $email }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div
                class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <p>© {{ date('Y') }} શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ. સર્વાધિકાર સુરક્ષિત.</p>
                <p class="font-medium text-amber-400/90 flex items-center gap-1.5">
                    <i class="fa-solid fa-hands-praying text-amber-400"></i>
                    <span>સમાજ સેવા એ જ પ્રભુ સેવા</span>
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
