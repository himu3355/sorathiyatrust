<x-filament-panels::page>
    <!-- Include Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b', 950: '#022c22'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-card {
            background-color: #111827;
            border: 1px solid #1f2937;
            border-radius: 1rem;
            padding: 1.5rem;
        }
    </style>

    <div class="space-y-8 text-gray-100">
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 rounded-2xl p-6 text-white shadow-xl border border-emerald-700/50">
            <h1 class="text-xl font-extrabold font-gujarati flex items-center gap-3">
                <i class="fa-solid fa-screwdriver-wrench text-amber-400 text-2xl"></i>
                <span>સિસ્ટમ એક્સપોર્ટ અને ચકાસણી ટૂલ્સ (System Tools & Utilities)</span>
            </h1>
            <p class="text-xs sm:text-sm text-emerald-100 mt-1 font-gujarati">
                ડેટાબેઝ એક્સપોર્ટ ફાઈલો અને ડુપ્લીકેટ ચકાસણી ટૂલ્સ.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Families Export Card -->
            <div class="custom-card shadow-sm space-y-5 hover:border-emerald-500/50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-house-user"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white font-gujarati">
                            પરિવારો ની વિગત એક્સપોર્ટ (Export Families)
                        </h2>
                        <p class="text-xs text-gray-400">કુલ પરિવારો ની માહિતી Excel/CSV ફાઈલમાં ડાઉનલોડ કરો.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('admin.tools.export.families') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-md transition-all text-xs">
                        <i class="fa-solid fa-file-csv"></i>
                        <span>Export Families CSV File</span>
                    </a>
                </div>
            </div>

            <!-- Members Export Card -->
            <div class="custom-card shadow-sm space-y-5 hover:border-teal-500/50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-users font-bold"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white font-gujarati">
                            સભ્યો ની વિગત એક્સપોર્ટ (Export Members)
                        </h2>
                        <p class="text-xs text-gray-400">બધા સભ્યો ની તમામ માહિતી Excel/CSV ફાઈલમાં ડાઉનલોડ કરો.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('admin.tools.export.members') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 bg-teal-600 hover:bg-teal-500 text-white font-bold rounded-xl shadow-md transition-all text-xs">
                        <i class="fa-solid fa-file-csv"></i>
                        <span>Export Members CSV File</span>
                    </a>
                </div>
            </div>

            <!-- Duplicate Member Names Card -->
            <div class="custom-card shadow-sm space-y-5 hover:border-amber-500/50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white font-gujarati">
                            ડુપ્લીકેટ સભ્ય નામ ચકાસો (Duplicate Names)
                        </h2>
                        <p class="text-xs text-gray-400">એકથી વધુ વખત ઉમેરાયેલ સભ્યો ના નામ શોધો.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="button" onclick="checkFilamentDuplicates('member')" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 bg-amber-500 hover:bg-amber-400 text-gray-950 font-bold rounded-xl shadow-md transition-all text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>ચકાસણી કરો (Check Duplicate Names)</span>
                    </button>
                </div>
            </div>

            <!-- Duplicate Mobile Numbers Card -->
            <div class="custom-card shadow-sm space-y-5 hover:border-amber-500/50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-phone-slash"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white font-gujarati">
                            ડુપ્લીકેટ મોબાઈલ નંબર ચકાસો (Duplicate Mobiles)
                        </h2>
                        <p class="text-xs text-gray-400">એકથી વધુ વખત વપરાયેલ મોબાઈલ નંબર શોધો.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="button" onclick="checkFilamentDuplicates('mobile')" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 bg-amber-500 hover:bg-amber-400 text-gray-950 font-bold rounded-xl shadow-md transition-all text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>ચકાસણી કરો (Check Duplicate Mobiles)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Duplicate Modal -->
    <div id="filamentDuplicateModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-gray-900 rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-gray-800">
            <div class="p-5 bg-gray-950 text-white flex justify-between items-center border-b border-gray-800">
                <h3 class="text-sm font-bold font-gujarati flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
                    <span>ડુપ્લીકેટ ચકાસણી પરિણામ (Duplicate Results)</span>
                </h3>
                <button type="button" onclick="closeFilamentDuplicateModal()" class="text-gray-400 hover:text-white text-lg">✕</button>
            </div>
            <div class="p-6 max-h-[60vh] overflow-y-auto" id="filamentDuplicateResultsBody">
            </div>
            <div class="p-4 bg-gray-950 border-t border-gray-800 text-right">
                <button type="button" onclick="closeFilamentDuplicateModal()" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-white font-bold text-xs rounded-xl">
                    બંધ કરો
                </button>
            </div>
        </div>
    </div>

    <script>
    function checkFilamentDuplicates(type) {
        document.getElementById('filamentDuplicateModal').classList.remove('hidden');
        const container = document.getElementById('filamentDuplicateResultsBody');
        container.innerHTML = '<div class="text-center py-6 text-gray-400 text-xs font-gujarati"><i class="fa-solid fa-spinner animate-spin text-xl text-emerald-400 block mb-2"></i>ડેટાબેઝ ચકાસણી થઈ રહી છે...</div>';

        fetch('{{ route("admin.tools.duplicates") }}?type=' + type)
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success') {
                if(res.data.length === 0) {
                    container.innerHTML = '<div class="p-4 rounded-xl bg-emerald-950/60 text-emerald-300 font-bold text-center text-xs font-gujarati border border-emerald-800 space-y-1"><i class="fa-solid fa-circle-check text-emerald-400 text-xl block mb-1"></i><span>કોઈ ડુપ્લીકેટ રેકોર્ડ મળ્યો નથી. (No duplicate entries found)</span></div>';
                } else {
                    let html = '<div class="space-y-2 text-xs font-gujarati"><p class="text-gray-400 mb-3">નીચે દર્શાવેલ એન્ટ્રીઓ એકથી વધુ વખત જોવા મળી છે:</p><ul class="divide-y divide-gray-800">';
                    res.data.forEach(item => {
                        const label = item.member_name_guj || item.mobile;
                        html += `<li class="py-3 flex justify-between items-center"><span class="font-bold text-white">${label}</span><span class="px-3 py-1 rounded-full bg-amber-950 text-amber-300 font-bold text-xs border border-amber-800">${item.total} વખત</span></li>`;
                    });
                    html += '</ul></div>';
                    container.innerHTML = html;
                }
            } else {
                container.innerHTML = '<div class="p-4 rounded-xl bg-rose-950 text-rose-300 font-bold text-center text-xs border border-rose-800">ચકાસણી કરવામાં ભૂલ આવી છે.</div>';
            }
        });
    }

    function closeFilamentDuplicateModal() {
        document.getElementById('filamentDuplicateModal').classList.add('hidden');
    }
    </script>
</x-filament-panels::page>
