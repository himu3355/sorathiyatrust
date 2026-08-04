<x-filament-panels::page>
    <!-- Include Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end pt-4">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-gray-950 font-bold rounded-xl shadow-md transition-all text-xs sm:text-sm">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>સેવ સેટિંગ્સ (Save Site Settings)</span>
            </button>
        </div>
    </form>
</x-filament-panels::page>
