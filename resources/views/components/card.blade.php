@props(['hover' => true])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden transition-all duration-300 ' . ($hover ? 'hover:shadow-lg hover:-translate-y-1 hover:border-amber-300' : '')]) }}>
    {{ $slot }}
</div>
