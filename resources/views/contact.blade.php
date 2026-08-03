@extends('layouts.app')

@section('title', 'સંપર્ક - શ્રી દશા સોરાઠિયા વાણિયા સમાજ')

@section('content')
    <x-page-header icon="fa-solid fa-address-book" title="સંપર્ક કરો (Contact Us)" subtitle="શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન), રાજકોટ" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Contact Details -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                <h2 class="text-xl font-extrabold text-slate-900 font-gujarati flex items-center gap-2.5">
                    <i class="fa-solid fa-location-dot text-amber-600"></i>
                    <span>ટ્રસ્ટ કાર્યાલય સરનામું (Office Address)</span>
                </h2>
                <div class="space-y-4 text-sm text-slate-700 font-gujarati">
                    <p class="flex items-start gap-3">
                        <i class="fa-solid fa-landmark text-amber-600 text-lg mt-0.5"></i>
                        <span>
                            <strong>મહાજન વાડી / ટ્રસ્ટ ભવન:</strong><br>
                            શ્રી દશા સોરાઠિયા વાણિયા સમાજ (મહાજન),<br>
                            રાજકોટ, ગુજરાત - ૩૬૦૦૦૧.
                        </span>
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fa-solid fa-phone-volume text-amber-600 text-lg"></i>
                        <span><strong>ફોન નંબર:</strong> +91 98765 43210</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-amber-600 text-lg"></i>
                        <span><strong>ઇમેઇલ:</strong> info@trustwebsite.org</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fa-solid fa-clock text-amber-600 text-lg"></i>
                        <span><strong>સમય:</strong> સવારે ૯:૦૦ થી સાંજે ૬:૦૦ (રવિવાર રજા)</span>
                    </p>
                    <div class="pt-4 border-t border-slate-100">
                        <a href="https://wa.me/919876543210" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-md transition-all text-xs font-gujarati">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>વોટ્સએપ પર સીધો સંપર્ક (WhatsApp Us)</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Inquiry Form -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h2 class="text-xl font-extrabold text-slate-900 font-gujarati mb-6 flex items-center gap-2.5">
                    <i class="fa-solid fa-comments text-amber-600"></i>
                    <span>ઓનલાઇન પૂછપરછ (Inquiry Form)</span>
                </h2>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-gujarati">તમારું નામ (Name) *</label>
                        <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-800 bg-slate-50 font-gujarati text-sm">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-gujarati">મોબાઇલ નંબર (Mobile) *</label>
                            <input type="text" name="mobile" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-800 bg-slate-50 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-gujarati">ઇમેઇલ (Email)</label>
                            <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-800 bg-slate-50 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-gujarati">વિષય (Subject) *</label>
                        <input type="text" name="subject" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-800 bg-slate-50 font-gujarati text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 font-gujarati">સંદેશ / રજૂઆત (Message) *</label>
                        <textarea name="message" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-800 bg-slate-50 font-gujarati text-sm"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-xl shadow-md transition-all text-sm font-gujarati flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>સંદેશ મોકલો (Submit Inquiry)</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
