<x-filament-panels::page>
    <!-- Include Tailwind CSS & FontAwesome to ensure custom Filament views render with rich styles -->
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
        .light .custom-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
        }
    </style>

    <div class="space-y-8 text-gray-100">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 rounded-2xl p-6 sm:p-8 text-white shadow-xl border border-emerald-700/50">
            <h1 class="text-xl sm:text-2xl font-extrabold font-gujarati flex items-center gap-3">
                <i class="fa-solid fa-file-pdf text-amber-400 text-2xl"></i>
                <span>વસ્તીપત્રક PDF AI ડેટા એક્સટ્રેક્શન (PDF Data Extraction)</span>
            </h1>
            <p class="text-xs sm:text-sm text-emerald-100 mt-2 font-gujarati">
                ગુજરાતી વસ્તીપત્રક ની PDF અપલોડ કરો. Google Gemini AI આપમેળે પરિવારો અને સભ્યો નો ડેટા ઓળખી ને એક્સટ્રેક્ટ કરશે.
            </p>
        </div>

        <!-- Step 1: Upload Card -->
        <div class="custom-card shadow-md space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">1</span>
                <div>
                    <h2 class="text-base font-bold text-white font-gujarati">
                        સ્ટેપ 1: PDF ફાઈલ પસંદ કરો (Choose PDF File)
                    </h2>
                    <p class="text-xs text-gray-400">વસ્તીપત્રકની PDF ફાઈલ સીધી ડ્રેગ અથવા સિલેક્ટ કરો.</p>
                </div>
            </div>

            <form id="filamentPdfUploadForm" class="space-y-6">
                @csrf
                <!-- Drag and Drop Zone -->
                <div id="dropZone" class="border-2 border-dashed border-emerald-500/40 hover:border-emerald-400 rounded-2xl p-8 sm:p-10 text-center bg-gray-950/50 transition-all cursor-pointer group">
                    <input type="file" id="pdfFileInput" name="pdf" accept="application/pdf" required class="hidden">
                    <div id="dropZoneContent" class="space-y-3">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <div class="text-sm font-semibold text-gray-200 font-gujarati">
                            <span class="text-emerald-400 font-bold underline">PDF ફાઈલ પસંદ કરવા અહી ક્લિક કરો</span> અથવા ડ્રેગ એન્ડ ડ્રોપ કરો
                        </div>
                        <p class="text-xs text-gray-400">મહત્તમ ફાઈલ સાઈઝ: 50MB (.pdf)</p>
                    </div>
                    <!-- Selected File Info -->
                    <div id="selectedFileInfo" class="hidden text-sm font-bold text-emerald-400 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                        <span id="fileNameDisplay">filename.pdf</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" id="btnFilamentUpload" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm rounded-xl shadow-lg transition-all">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>AI દ્વારા ડેટા કાઢો (Start AI Extraction)</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Animated Loading Processing Card -->
        <div id="filamentLoadingArea" class="hidden custom-card border-amber-500/40 text-center py-12 space-y-4">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-3xl animate-spin">
                <i class="fa-solid fa-spinner"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-amber-300 font-gujarati">
                    AI દ્વારા PDF સ્કેન થઈ રહી છે...
                </h3>
                <p class="text-xs text-gray-400 max-w-md mx-auto mt-1 font-gujarati">
                    Google Gemini AI દ્વારા વિગતો ચકાસાઈ રહી છે. કૃપા કરીને થોડી ક્ષણો રાહ જુઓ.
                </p>
            </div>
        </div>

        <!-- Step 2: Live Preview Area -->
        <div id="filamentPreviewArea" class="hidden custom-card p-0 overflow-hidden space-y-0">
            <div class="p-6 bg-gradient-to-r from-emerald-800 to-teal-800 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-sm">2</span>
                    <div>
                        <h2 class="text-base font-bold font-gujarati">
                            સ્ટેપ 2: એક્સટ્રેક્ટ થયેલો ડેટા (Live Preview)
                        </h2>
                        <p class="text-xs text-emerald-100">નીચેના કોષ્ટકમાં ચકાસી ને સેવ બટન દબાવો.</p>
                    </div>
                </div>
                <button id="btnFilamentSaveData" class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-400 hover:bg-amber-500 text-gray-950 font-extrabold text-xs rounded-xl shadow-md transition-all">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>ડેટાબેઝમાં સેવ કરો</span>
                </button>
            </div>

            <div class="p-4 overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse" id="filamentPreviewTable">
                    <thead>
                        <tr class="bg-gray-800 text-gray-300 font-bold border-b border-gray-700">
                            <th class="p-3">પરિવાર કોડ</th>
                            <th class="p-3">મુખ્ય સભ્ય</th>
                            <th class="p-3">અટક</th>
                            <th class="p-3">ગામ</th>
                            <th class="p-3">સરનામું</th>
                            <th class="p-3 text-center">સભ્યો</th>
                            <th class="p-3 text-right">એક્શન</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-gray-200 font-gujarati">
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Members Inspection Modal -->
    <div id="filamentMembersModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-gray-900 rounded-2xl max-w-4xl w-full shadow-2xl overflow-hidden border border-gray-800">
            <div class="p-5 bg-gray-950 text-white flex justify-between items-center border-b border-gray-800">
                <h3 class="text-sm font-bold font-gujarati flex items-center gap-2">
                    <i class="fa-solid fa-users text-amber-400"></i>
                    <span>પરિવારના સભ્યોની વિગત (Member Details)</span>
                </h3>
                <button type="button" onclick="closeFilamentMembersModal()" class="text-gray-400 hover:text-white text-lg">✕</button>
            </div>
            <div class="p-5 max-h-[60vh] overflow-y-auto">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs" id="filamentMembersPreviewTable">
                        <thead>
                            <tr class="bg-gray-800 text-gray-300 font-bold border-b border-gray-700">
                                <th class="p-2.5">નામ</th>
                                <th class="p-2.5">સંબંધ</th>
                                <th class="p-2.5">ઉંમર</th>
                                <th class="p-2.5">જન્મ સ્થળ</th>
                                <th class="p-2.5">જન્મ તારીખ</th>
                                <th class="p-2.5">સ્થિતિ</th>
                                <th class="p-2.5">મોસાળની અટક</th>
                                <th class="p-2.5">અભ્યાસ</th>
                                <th class="p-2.5">વ્યવસાય</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800 text-gray-200 font-gujarati">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="p-4 bg-gray-950 border-t border-gray-800 text-right">
                <button type="button" onclick="closeFilamentMembersModal()" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-white font-bold text-xs rounded-xl">
                    બંધ કરો
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    let filamentExtractedData = [];

    const dropZone = document.getElementById('dropZone');
    const pdfFileInput = document.getElementById('pdfFileInput');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const selectedFileInfo = document.getElementById('selectedFileInfo');
    const fileNameDisplay = document.getElementById('fileNameDisplay');

    dropZone.addEventListener('click', () => pdfFileInput.click());

    pdfFileInput.addEventListener('change', () => {
        if(pdfFileInput.files.length > 0) {
            fileNameDisplay.textContent = pdfFileInput.files[0].name;
            dropZoneContent.classList.add('hidden');
            selectedFileInfo.classList.remove('hidden');
        }
    });

    ['dragover', 'dragenter'].forEach(evtName => {
        dropZone.addEventListener(evtName, (e) => { e.preventDefault(); dropZone.classList.add('border-emerald-400'); });
    });
    ['dragleave', 'drop'].forEach(evtName => {
        dropZone.addEventListener(evtName, (e) => { e.preventDefault(); dropZone.classList.remove('border-emerald-400'); });
    });
    dropZone.addEventListener('drop', (e) => {
        if(e.dataTransfer.files.length > 0) {
            pdfFileInput.files = e.dataTransfer.files;
            fileNameDisplay.textContent = e.dataTransfer.files[0].name;
            dropZoneContent.classList.add('hidden');
            selectedFileInfo.classList.remove('hidden');
        }
    });

    document.getElementById('filamentPdfUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        if(pdfFileInput.files.length === 0) {
            Swal.fire('Error', 'Please select a PDF file first.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('pdf', pdfFileInput.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        document.getElementById('btnFilamentUpload').disabled = true;
        document.getElementById('filamentLoadingArea').classList.remove('hidden');
        document.getElementById('filamentPreviewArea').classList.add('hidden');

        fetch('{{ route("admin.pdf.process") }}', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('btnFilamentUpload').disabled = false;
            document.getElementById('filamentLoadingArea').classList.add('hidden');

            if(data.status === 'success') {
                filamentExtractedData = data.data;
                renderFilamentPreview();
                document.getElementById('filamentPreviewArea').classList.remove('hidden');
                Swal.fire('Success', 'માહિતી સફળતાપૂર્વક AI દ્વારા એક્સટ્રેક્ટ થઈ ગઈ છે.', 'success');
            } else {
                Swal.fire('Error', data.message || 'AI extraction failed.', 'error');
            }
        })
        .catch(err => {
            document.getElementById('btnFilamentUpload').disabled = false;
            document.getElementById('filamentLoadingArea').classList.add('hidden');
            Swal.fire('Error', err.message || 'An error occurred while processing PDF.', 'error');
        });
    });

    function renderFilamentPreview() {
        const tbody = document.querySelector('#filamentPreviewTable tbody');
        tbody.innerHTML = '';

        filamentExtractedData.forEach((fam, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-800/60 transition-colors';
            tr.innerHTML = `
                <td class="p-3 font-mono font-bold">${fam.family_code || '-'}</td>
                <td class="p-3 font-bold text-white">${fam.main_member_name_guj || '-'}</td>
                <td class="p-3">${fam.surname_guj || '-'}</td>
                <td class="p-3"><span class="px-2.5 py-1 rounded-full bg-emerald-950 text-emerald-300 text-xs font-bold border border-emerald-800">${fam.village || '-'}</span></td>
                <td class="p-3 text-xs text-gray-400">${fam.address || '-'}</td>
                <td class="p-3 text-center font-bold">${(fam.members || []).length} સભ્યો</td>
                <td class="p-3 text-right">
                    <button type="button" class="px-3 py-1.5 bg-gray-800 hover:bg-emerald-600 hover:text-white font-bold text-xs rounded-xl transition-all inline-flex items-center gap-1.5" onclick="viewFilamentMembers(${idx})">
                        <i class="fa-solid fa-eye text-xs"></i> <span>જુઓ</span>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function viewFilamentMembers(idx) {
        const fam = filamentExtractedData[idx];
        const tbody = document.querySelector('#filamentMembersPreviewTable tbody');
        tbody.innerHTML = '';

        (fam.members || []).forEach(m => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-2.5 font-bold">${m.name_guj || '-'}</td>
                <td class="p-2.5">${m.relation || '-'}</td>
                <td class="p-2.5">${m.age || '-'}</td>
                <td class="p-2.5">${m.birth_place || '-'}</td>
                <td class="p-2.5">${m.birth_date || '-'}</td>
                <td class="p-2.5">${m.marital_status || '-'}</td>
                <td class="p-2.5 font-bold text-emerald-400">${m.maternal_surname || '-'}</td>
                <td class="p-2.5">${m.education || '-'}</td>
                <td class="p-2.5">${m.occupation || '-'}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('filamentMembersModal').classList.remove('hidden');
    }

    function closeFilamentMembersModal() {
        document.getElementById('filamentMembersModal').classList.add('hidden');
    }

    document.getElementById('btnFilamentSaveData').addEventListener('click', function() {
        if(filamentExtractedData.length === 0) return;

        Swal.fire({
            title: 'શું તમે ચોક્કસ છો?',
            text: "આ બધો એક્સટ્રેક્ટ થયેલો ડેટા ડેટાબેઝમાં સેવ થઈ જશે.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'હા, સેવ કરો',
            cancelButtonText: 'કેન્સલ'
        }).then((res) => {
            if(res.isConfirmed) {
                Swal.fire({ title: 'Saving...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

                fetch('{{ route("admin.pdf.save") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ families: filamentExtractedData })
                })
                .then(r => r.json())
                .then(data => {
                    if(data.status === 'success') {
                        Swal.fire('Saved!', 'બધો ડેટા ડેટાબેઝમાં સફળતાપૂર્વક ઉમેરાઈ ગયો છે.', 'success');
                    } else {
                        Swal.fire('Error', data.message || 'Failed to save.', 'error');
                    }
                });
            }
        });
    });
    </script>
</x-filament-panels::page>
