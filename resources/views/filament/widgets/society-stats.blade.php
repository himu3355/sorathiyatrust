<x-filament-widgets::widget>
    <style>
        .trust-stat-card {
            background: #FDF8F0;
            --card-text: #3A2A17;
            --card-label: #8A6A3E;
        }

        .dark .trust-stat-card {
            background: #23201A;
            --card-text: #F3EBDD;
            --card-label: #C7B79A;
        }
    </style>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
        @foreach ($stats as $stat)
            <div class="trust-stat-card"
                style="
                border-left: 4px solid {{ $stat['accent'] }};
                border-radius: 0 12px 12px 0;
                padding: 1.1rem 1.25rem;
            ">
                <div
                    style="
                    width: 36px; height: 36px; border-radius: 50%;
                    background: {{ $stat['tint'] }};
                    display: flex; align-items: center; justify-content: center;
                    margin-bottom: 10px;
                ">
                    <x-filament::icon :icon="$stat['icon']"
                        style="width: 18px; height: 18px; color: {{ $stat['iconColor'] }};" />
                </div>
                <div style="font-size: 26px; font-weight: 600; color: var(--card-text);">
                    {{ $stat['value'] }}
                </div>
                <div style="margin-top: 10px; border-bottom: 2px dotted {{ $stat['accent'] }}66;"></div>
                <div style="font-size: 13px; color: var(--card-label); margin-top: 4px; line-height: 1.3;">
                    {{ $stat['label_gu'] }}<br>{{ $stat['label_en'] }}
                </div>
            </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
