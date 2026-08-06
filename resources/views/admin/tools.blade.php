@extends('layouts.app')

@section('meta_title', 'સિસ્ટમ ટૂલ્સ - એડમિન પોર્ટલ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                <i class="fa-solid fa-toolbox text-emerald-800"></i>
                <span>સિસ્ટમ ટૂલ્સ (System Tools)</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">એક્સેલ એક્સપોર્ટ, ડુપ્લીકેટ ચકાસણી અને ડેટાબેઝ મેનેજમેન્ટ.</p>
        </div>
        <a href="{{ config('app.url') }}/admin" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition-colors">
            <i class="fa-solid fa-arrow-left me-1"></i> એડમિન પોર્ટલ
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Excel Export Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b pb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold">
                    <i class="fa-solid fa-file-excel"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900 font-gujarati">Excel નિકાસ (Export Data)</h2>
                    <p class="text-xs text-slate-500">પરિવારો અને સભ્યો ની વિગત Excel/CSV ફાઈલમાં ડાઉનલોડ કરો.</p>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('admin.tools.export.families') }}" class="w-full py-3.5 px-6 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-2xl shadow-sm transition-all flex items-center justify-center gap-3 text-sm">
                    <i class="fa-solid fa-file-csv"></i>
                    <span>કુલ પરિવારો ની વિગત એક્સપોર્ટ કરો (Families CSV)</span>
                </a>

                <a href="{{ route('admin.tools.export.members') }}" class="w-full py-3.5 px-6 bg-teal-800 hover:bg-teal-900 text-white font-bold rounded-2xl shadow-sm transition-all flex items-center justify-center gap-3 text-sm">
                    <i class="fa-solid fa-file-csv"></i>
                    <span>કુલ સભ્યો ની વિગત એક્સપોર્ટ કરો (Members CSV)</span>
                </a>
            </div>
        </div>

        <!-- Duplicates & Database Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b pb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                    <i class="fa-solid fa-database"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900 font-gujarati">ડુપ્લીકેટ ચકાસણી (Duplicate Inspection)</h2>
                    <p class="text-xs text-slate-500">સિસ્ટમમાં સભ્યોના નામ અથવા ફોન નંબર ની ડુપ્લીકેટ એન્ટ્રી ચકાસો.</p>
                </div>
            </div>

            <div class="space-y-4">
                <button type="button" onclick="checkDuplicates('member')" class="w-full py-3.5 px-6 bg-amber-500 hover:bg-amber-600 text-amber-950 font-bold rounded-2xl shadow-sm transition-all flex items-center justify-center gap-3 text-sm">
                    <i class="fa-solid fa-user-xmark"></i>
                    <span>ડુપ્લીકેટ સભ્ય નામ ચકાસો (Duplicate Names)</span>
                </button>

                <button type="button" onclick="checkDuplicates('mobile')" class="w-full py-3.5 px-6 bg-amber-500 hover:bg-amber-600 text-amber-950 font-bold rounded-2xl shadow-sm transition-all flex items-center justify-center gap-3 text-sm">
                    <i class="fa-solid fa-phone-slash"></i>
                    <span>ડુપ્લીકેટ મોબાઈલ નંબર ચકાસો (Duplicate Mobiles)</span>
                </button>
            </div>
        </div>

    </div>

</div>

<!-- Duplicate Modal -->
<div id="duplicateModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-200">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="text-base font-bold font-gujarati flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
                <span>ડુપ્લીકેટ ચકાસણી પરિણામ</span>
            </h3>
            <button type="button" onclick="closeDuplicateModal()" class="text-slate-400 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="p-6 max-h-[60vh] overflow-y-auto" id="duplicateResultsBody">
            <div class="text-center py-6 text-slate-500">
                <i class="fa-solid fa-spinner animate-spin text-2xl mb-2 text-emerald-800"></i>
                <p>ચકાસણી થઈ રહી છે...</p>
            </div>
        </div>
        <div class="p-4 bg-slate-50 border-t border-slate-100 text-right">
            <button type="button" onclick="closeDuplicateModal()" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl">
                બંધ કરો
            </button>
        </div>
    </div>
</div>

<script>
function checkDuplicates(type) {
    document.getElementById('duplicateModal').classList.remove('hidden');
    const container = document.getElementById('duplicateResultsBody');
    container.innerHTML = '<div class="text-center py-6 text-slate-500"><i class="fa-solid fa-spinner animate-spin text-2xl mb-2 text-emerald-800"></i><p class="font-gujarati">ચકાસણી થઈ રહી છે...</p></div>';

    fetch('{{ route("admin.tools.duplicates") }}?type=' + type)
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success') {
            if(res.data.length === 0) {
                container.innerHTML = '<div class="p-4 rounded-2xl bg-emerald-50 text-emerald-900 font-bold text-center font-gujarati"><i class="fa-solid fa-circle-check text-emerald-600 text-xl block mb-1"></i>કોઈ ડુપ્લીકેટ રેકોર્ડ મળ્યો નથી. (No duplicates found)</div>';
            } else {
                let html = '<div class="space-y-2 font-gujarati"><p class="text-xs text-slate-500 mb-3">નીચે દર્શાવેલ એન્ટ્રીઓ એકથી વધુ વખત જોવા મળી છે:</p><ul class="divide-y divide-slate-100">';
                res.data.forEach(item => {
                    const label = item.member_name_guj || item.mobile;
                    html += `<li class="py-2.5 flex justify-between items-center text-sm"><span class="font-bold text-slate-800">${label}</span><span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-bold text-xs">${item.total} વખત</span></li>`;
                });
                html += '</ul></div>';
                container.innerHTML = html;
            }
        } else {
            container.innerHTML = '<div class="p-4 rounded-2xl bg-rose-50 text-rose-900 font-bold text-center">ચકાસણી કરવામાં ભૂલ આવી છે.</div>';
        }
    })
    .catch(err => {
        container.innerHTML = '<div class="p-4 rounded-2xl bg-rose-50 text-rose-900 font-bold text-center">ચકાસણી કરવામાં ભૂલ આવી છે.</div>';
    });
}

function closeDuplicateModal() {
    document.getElementById('duplicateModal').classList.add('hidden');
}
</script>
@endsection
