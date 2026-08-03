@props(['color' => 'amber'])

@php
$classes = match($color) {
    'red' => 'bg-red-100 text-red-800 border-red-200',
    'emerald' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
    'amber' => 'bg-amber-100 text-amber-900 border-amber-300',
    'blue' => 'bg-blue-100 text-blue-800 border-blue-200',
    default => 'bg-slate-100 text-slate-800 border-slate-200',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {$classes}"]) }}>
    {{ $slot }}
</span>
