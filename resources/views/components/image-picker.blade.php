{{--
    Image Picker Component
    Usage:
        <x-image-picker name="hero_image" label="Hero Banner" :value="$settings['hero_image'] ?? ''" />

    Props:
        name    – form field name (stored in settings table)
        label   – display label
        value   – current URL value
        hint    – optional helper text
--}}
@props([
    'name',
    'label',
    'value' => '',
    'hint'  => '',
])

<div x-data="imagePicker('{{ $name }}', '{{ $value }}')" class="space-y-2">
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>

    {{-- Hidden input sent with form --}}
    <input type="hidden" :name="'{{ $name }}'" :value="selected">

    {{-- Preview + pick button --}}
    <div class="flex items-start gap-3">
        {{-- Preview box --}}
        <div class="flex-shrink-0 w-32 h-20 rounded-lg border-2 border-dashed border-gray-300 overflow-hidden bg-gray-50 flex items-center justify-center">
            <template x-if="selected">
                <img :src="selected" class="w-full h-full object-cover">
            </template>
            <template x-if="!selected">
                <span class="text-xs text-gray-400 text-center px-2">No image</span>
            </template>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col gap-2">
            <button type="button"
                    @click="$dispatch('open-media-picker', { target: '{{ $name }}' })"
                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-images text-gray-400"></i> Select Image
            </button>
            <template x-if="selected">
                <button type="button" @click="selected = ''"
                        class="text-xs text-red-500 hover:text-red-700 text-left">
                    <i class="fas fa-times mr-1"></i> Remove
                </button>
            </template>
        </div>
    </div>

    @if($hint)
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif
</div>

@once
@push('scripts')
<script>
function imagePicker(name, initial) {
    return {
        selected: initial,
        init() {
            // Listen for selection event from the global modal
            window.addEventListener('media-picked', (e) => {
                if (e.detail.target === name) {
                    this.selected = e.detail.url;
                }
            });
        }
    }
}
</script>
@endpush
@endonce
