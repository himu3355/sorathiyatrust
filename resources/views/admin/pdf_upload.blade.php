@extends('layouts.app')

@section('meta_title', 'AI PDF વસ્તીપત્રક ઇમ્પોર્ટ - એડમિન પોર્ટલ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Title Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-gujarati flex items-center gap-3">
                <i class="fa-solid fa-file-pdf text-red-600"></i>
                <span>PDF અપલોડ અને ઓટોમેટિક AI ડેટા એક્સટ્રેક્શન</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">વસ્તીપત્રક PDF ફાઈલ અપલોડ કરી AI દ્વારા ઓટોમેટિક ડેટાબેઝ ઇમ્પોર્ટ કરો.</p>
        </div>
        <a href="/admin" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition-colors">
            <i class="fa-solid fa-arrow-left me-1"></i> એડમિન પોર્ટલ
        </a>
    </div>

    <!-- Step 1: Upload Box -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 mb-8">
        <h2 class="text-lg font-bold text-slate-800 font-gujarati border-b pb-3 mb-6 flex items-center gap-2">
            <span class="w-7 h-7 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs">1</span>
            <span>સ્ટેપ 1: PDF ફાઈલ પસંદ કરી અપલોડ કરો</span>
        </h2>

        <form id="pdfUploadForm" class="space-y-6">
            @csrf
            <div>
                <label for="pdfFile" class="block text-sm font-bold text-slate-700 mb-2">વસ્તીપત્રક PDF ફાઈલ પસંદ કરો (.pdf format only)</label>
                <input type="file" id="pdfFile" name="pdf" accept="application/pdf" required 
                       class="w-full px-4 py-3 rounded-2xl border border-slate-300 bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800">
            </div>

            <button type="submit" id="btnUpload" class="px-8 py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-2xl shadow-md transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span>અપલોડ કરો અને ડેટા એક્સટ્રેક્ટ કરો</span>
            </button>
        </form>
    </div>

    <!-- Loading State Area -->
    <div id="loadingArea" class="hidden bg-white rounded-3xl border border-amber-200 p-12 text-center shadow-sm space-y-4 my-8">
        <div class="w-16 h-16 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-3xl animate-spin">
            <i class="fa-solid fa-spinner"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 font-gujarati">AI દ્વારા PDF માંથી ડેટા એક્સટ્રેક્ટ થઈ રહ્યો છે...</h3>
        <p class="text-sm text-slate-500 max-w-md mx-auto">Google Gemini AI ટેકનોલોજી દ્વારા ગુજરાતી નામ, સરનામાં અને સભ્યો ઓટોમેટિક અલગ થઈ રહ્યા છે. કૃપા કરીને થોડી ક્ષણો રાહ જુઓ.</p>
    </div>

    <!-- Step 2: Preview Area -->
    <div id="previewArea" class="hidden bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <div class="p-6 bg-emerald-900 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-bold font-gujarati flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-amber-400 text-amber-950 flex items-center justify-center text-xs font-extrabold">2</span>
                    <span>સ્ટેપ 2: એક્સટ્રેક્ટ થયેલો ડેટા ચકાસો (Live Preview)</span>
                </h2>
                <p class="text-xs text-emerald-200 mt-1">નીચેના કોષ્ટકમાં ચકાસી ને સેવ બટન દબાવો.</p>
            </div>
            <button id="btnSaveData" class="px-6 py-2.5 bg-amber-400 hover:bg-amber-500 text-amber-950 font-extrabold text-xs rounded-xl shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>ડેટાબેઝમાં સેવ કરો</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm" id="previewTable">
                <thead>
                    <tr class="bg-slate-100 border-b border-slate-200 text-slate-700 font-bold">
                        <th class="p-4">પરિવાર કોડ</th>
                        <th class="p-4">મુખ્ય સભ્ય (ગુજરાતી)</th>
                        <th class="p-4">અટક</th>
                        <th class="p-4">મૂળ ગામ</th>
                        <th class="p-4">સરનામું</th>
                        <th class="p-4">સભ્યો</th>
                        <th class="p-4">એક્શન</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-gujarati text-slate-800">
                    <!-- Populated dynamically by JS -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Members Inspection Modal -->
<div id="membersModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl overflow-hidden border border-slate-200">
        <div class="p-6 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="text-base font-bold font-gujarati flex items-center gap-2">
                <i class="fa-solid fa-users text-amber-400"></i>
                <span>પરિવારના સભ્યોની વિગત</span>
            </h3>
            <button type="button" onclick="closeMembersModal()" class="text-slate-400 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="p-6 max-h-[70vh] overflow-y-auto">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs" id="membersPreviewTable">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                            <th class="p-3">નામ</th>
                            <th class="p-3">સંબંધ</th>
                            <th class="p-3">ઉંમર</th>
                            <th class="p-3">જન્મ સ્થળ</th>
                            <th class="p-3">જન્મ તારીખ</th>
                            <th class="p-3">સ્થિતિ</th>
                            <th class="p-3">મોસાળની અટક</th>
                            <th class="p-3">અભ્યાસ</th>
                            <th class="p-3">વ્યવસાય</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-gujarati text-slate-800">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-slate-50 border-t border-slate-100 text-right">
            <button type="button" onclick="closeMembersModal()" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl">
                બંધ કરો
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let extractedFamiliesData = [];

document.getElementById('pdfUploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fileInput = document.getElementById('pdfFile');
    if(fileInput.files.length === 0) {
        Swal.fire('Error', 'કૃપા કરીને પહેલા PDF ફાઈલ પસંદ કરો.', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('pdf', fileInput.files[0]);
    formData.append('_token', '{{ csrf_token() }}');

    document.getElementById('btnUpload').disabled = true;
    document.getElementById('loadingArea').classList.remove('hidden');
    document.getElementById('previewArea').classList.add('hidden');

    fetch('{{ route("admin.pdf.process") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('btnUpload').disabled = false;
        document.getElementById('loadingArea').classList.add('hidden');

        if(data.status === 'success') {
            extractedFamiliesData = data.data;
            renderPreviewTable();
            document.getElementById('previewArea').classList.remove('hidden');
            Swal.fire('સફળતા!', 'માહિતી સફળતાપૂર્વક AI દ્વારા એક્સટ્રેક્ટ થઈ ગઈ છે. નીચે ચકાસો.', 'success');
        } else {
            Swal.fire('Error', data.message || 'માહિતી એક્સટ્રેક્ટ કરી શકાઈ નથી.', 'error');
        }
    })
    .catch(err => {
        document.getElementById('btnUpload').disabled = false;
        document.getElementById('loadingArea').classList.add('hidden');
        Swal.fire('Error', 'PDF પ્રોસેસ કરવામાં ભૂલ આવી છે.', 'error');
        console.error(err);
    });
});

function renderPreviewTable() {
    const tbody = document.querySelector('#previewTable tbody');
    tbody.innerHTML = '';
    
    extractedFamiliesData.forEach((fam, index) => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50 transition-colors';
        tr.innerHTML = `
            <td class="p-4 font-mono font-bold">${fam.family_code || '-'}</td>
            <td class="p-4 font-bold text-slate-900">${fam.main_member_name_guj || '-'}</td>
            <td class="p-4">${fam.surname_guj || '-'}</td>
            <td class="p-4"><span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">${fam.village || '-'}</span></td>
            <td class="p-4 text-xs text-slate-500">${fam.address || '-'}</td>
            <td class="p-4 font-bold">${(fam.members || []).length} સભ્યો</td>
            <td class="p-4">
                <button class="px-3 py-1.5 bg-slate-100 hover:bg-emerald-800 hover:text-white text-slate-700 text-xs font-bold rounded-xl transition-all" onclick="viewMembers(${index})">
                    <i class="fa-solid fa-eye me-1"></i> જુઓ
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function viewMembers(index) {
    const fam = extractedFamiliesData[index];
    const tbody = document.querySelector('#membersPreviewTable tbody');
    tbody.innerHTML = '';
    
    (fam.members || []).forEach(m => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="p-3 font-bold">${m.name_guj || '-'}</td>
            <td class="p-3">${m.relation || '-'}</td>
            <td class="p-3">${m.age || '-'}</td>
            <td class="p-3">${m.birth_place || '-'}</td>
            <td class="p-3">${m.birth_date || '-'}</td>
            <td class="p-3">${m.marital_status || '-'}</td>
            <td class="p-3 font-bold text-emerald-800">${m.maternal_surname || '-'}</td>
            <td class="p-3">${m.education || '-'}</td>
            <td class="p-3">${m.occupation || '-'}</td>
        `;
        tbody.appendChild(tr);
    });
    
    document.getElementById('membersModal').classList.remove('hidden');
}

function closeMembersModal() {
    document.getElementById('membersModal').classList.add('hidden');
}

document.getElementById('btnSaveData').addEventListener('click', function() {
    if(extractedFamiliesData.length === 0) return;
    
    Swal.fire({
        title: 'શું તમે ચોક્કસ છો?',
        text: "આ બધો એક્સટ્રેક્ટ થયેલો ડેટા ડેટાબેઝમાં સેવ થઈ જશે.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'હા, સેવ કરો',
        cancelButtonText: 'કેન્સલ'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'સેવ થઈ રહ્યું છે...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            fetch('{{ route("admin.pdf.save") }}', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ families: extractedFamiliesData })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire('Saved!', 'બધો ડેટા ડેટાબેઝમાં સફળતાપૂર્વક ઉમેરાઈ ગયો છે.', 'success')
                    .then(() => {
                        window.location.href = '{{ route("families.index") }}';
                    });
                } else {
                    Swal.fire('Error', data.message || 'ડેટા સેવ કરી શકાયો નથી.', 'error');
                }
            })
            .catch(err => {
                Swal.fire('Error', 'ડેટાબેઝમાં સેવ કરતી વખતે ભૂલ આવી છે.', 'error');
            });
        }
    });
});
</script>
@endsection
