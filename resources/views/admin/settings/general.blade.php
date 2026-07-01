@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<div x-data="mediaPicker()" class="max-w-2xl">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg text-sm">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.general.update') }}" method="POST" id="general-settings-form">
        @csrf

        {{-- ── 1. Store Information ──────────────────────────────────── --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-store text-blue-500"></i> Store Information
                </h3>
            </div>
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Name</label>
                        <input type="text" name="store_name"
                               value="{{ old('store_name', $settings['store_name'] ?? '') }}"
                               placeholder="SepatuKu"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Tampil di navbar, footer, dan tab browser.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Brand Name</label>
                        <input type="text" name="brand_name"
                               value="{{ old('brand_name', $settings['brand_name'] ?? '') }}"
                               placeholder="SepatuKu."
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Bisa berbeda dari nama toko, dipakai di logo text.</p>
                    </div>
                </div>

                {{-- Logo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Website</label>
                    <div class="flex items-start gap-4">
                        <div class="w-36 h-16 rounded-lg border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if(!empty($settings['logo']))
                                <img src="{{ $settings['logo'] }}" alt="Logo" class="max-h-full max-w-full object-contain p-1" id="logo-preview">
                            @else
                                <span class="text-xs text-gray-400 text-center px-2" id="logo-empty">No logo</span>
                                <img src="" alt="" class="hidden max-h-full max-w-full object-contain p-1" id="logo-preview">
                            @endif
                        </div>
                        <div class="space-y-2">
                            <input type="hidden" name="logo" id="logo-value" value="{{ old('logo', $settings['logo'] ?? '') }}">
                            <button type="button"
                                    @click="open('logo-value', 'logo-preview', 'logo-empty')"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-images text-gray-400"></i> Select Image
                            </button>
                            <button type="button" onclick="clearImage('logo-value','logo-preview','logo-empty')"
                                    class="block text-xs text-red-500 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Remove
                            </button>
                            <p class="text-xs text-gray-400">PNG transparan, maks 200×60px ideal.</p>
                        </div>
                    </div>
                </div>

                {{-- Favicon --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if(!empty($settings['favicon']))
                                <img src="{{ $settings['favicon'] }}" alt="Favicon" class="w-8 h-8 object-contain" id="favicon-preview">
                            @else
                                <span class="text-xs text-gray-400" id="favicon-empty"><i class="fas fa-globe text-lg"></i></span>
                                <img src="" alt="" class="hidden w-8 h-8 object-contain" id="favicon-preview">
                            @endif
                        </div>
                        <div class="space-y-2">
                            <input type="hidden" name="favicon" id="favicon-value" value="{{ old('favicon', $settings['favicon'] ?? '') }}">
                            <button type="button"
                                    @click="open('favicon-value', 'favicon-preview', 'favicon-empty')"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-images text-gray-400"></i> Select Image
                            </button>
                            <button type="button" onclick="clearImage('favicon-value','favicon-preview','favicon-empty')"
                                    class="block text-xs text-red-500 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Remove
                            </button>
                            <p class="text-xs text-gray-400">ICO atau PNG 32×32px.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── 2. Contact ────────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-address-book text-green-500"></i> Contact
                </h3>
            </div>
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-whatsapp text-green-500 mr-1"></i> WhatsApp
                    </label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">wa.me/</span>
                        <input type="text" name="whatsapp"
                               value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                               placeholder="628123456789"
                               class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Format internasional tanpa + · contoh: 628123456789</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-envelope text-blue-400 mr-1"></i> Email
                    </label>
                    <input type="email" name="site_email"
                           value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                           placeholder="hello@tokosepatu.com"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt text-red-400 mr-1"></i> Alamat Toko
                    </label>
                    <textarea name="site_address" rows="2"
                              placeholder="Jl. Contoh No. 123, Jakarta"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map text-yellow-500 mr-1"></i> Google Maps Link
                    </label>
                    <input type="url" name="google_maps_link"
                           value="{{ old('google_maps_link', $settings['google_maps_link'] ?? '') }}"
                           placeholder="https://maps.google.com/..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>
        </div>

        {{-- ── 3. Social Media ───────────────────────────────────────── --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-share-alt text-purple-500"></i> Social Media
                </h3>
            </div>
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-instagram text-pink-500 mr-1"></i> Instagram
                    </label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">instagram.com/</span>
                        <input type="text" name="instagram"
                               value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                               placeholder="username"
                               class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-tiktok text-gray-800 mr-1"></i> TikTok
                    </label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">tiktok.com/@</span>
                        <input type="text" name="tiktok"
                               value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"
                               placeholder="username"
                               class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">facebook.com/</span>
                        <input type="text" name="facebook"
                               value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                               placeholder="pagename"
                               class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

            </div>
        </div>

        {{-- ── 4. SEO ────────────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-search text-orange-400"></i> SEO Dasar
                </h3>
            </div>
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                    <input type="text" name="site_title"
                           value="{{ old('site_title', $settings['site_title'] ?? '') }}"
                           placeholder="SepatuKu – Sepatu Premium Terbaik"
                           maxlength="70"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="flex justify-between mt-1">
                        <p class="text-xs text-gray-400">Tampil di tab browser dan hasil Google. Maks 70 karakter.</p>
                        <span class="text-xs text-gray-400" id="title-count">0/70</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                              maxlength="160"
                              placeholder="Deskripsi singkat yang tampil di hasil pencarian Google..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    <div class="flex justify-between mt-1">
                        <p class="text-xs text-gray-400">Maks 160 karakter.</p>
                        <span class="text-xs text-gray-400" id="desc-count">0/160</span>
                    </div>
                </div>

            </div>
        </div>

        <button type="submit"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg font-medium transition">
            Simpan General Settings
        </button>
    </form>

    {{-- ── Media Picker Modal ──────────────────────────────────────────── --}}
    <div x-show="isOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black bg-opacity-60" @click="close()"></div>

        {{-- Modal box --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4 max-h-[85vh] flex flex-col z-10">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 flex-shrink-0">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Media Library</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pilih gambar untuk digunakan</p>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Upload quick --}}
                    <label class="inline-flex items-center gap-1.5 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium cursor-pointer transition">
                        <i class="fas fa-upload text-xs"></i> Upload
                        <input type="file" class="hidden" accept="image/*" multiple @change="uploadFiles($event)">
                    </label>
                    <button @click="close()" class="text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            {{-- Search --}}
            <div class="px-6 py-3 border-b border-gray-100 flex-shrink-0">
                <input type="text" x-model="search" @input.debounce.300ms="loadMedia(1)"
                       placeholder="Cari nama file..."
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Grid --}}
            <div class="flex-1 overflow-y-auto p-6">
                <div x-show="loading" class="flex items-center justify-center py-16">
                    <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
                </div>

                <div x-show="!loading && mediaItems.length === 0" class="text-center py-16 text-gray-400">
                    <i class="fas fa-images text-4xl mb-3 block"></i>
                    <p class="text-sm">Belum ada gambar. Upload dulu ya.</p>
                </div>

                <div x-show="!loading && mediaItems.length > 0"
                     class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">
                    <template x-for="item in mediaItems" :key="item.id">
                        <div @click="pick(item)"
                             class="group relative rounded-lg overflow-hidden border-2 cursor-pointer transition"
                             :class="selectedId === item.id ? 'border-blue-500 ring-2 ring-blue-300' : 'border-transparent hover:border-blue-300'">
                            <div class="aspect-square bg-gray-100">
                                <template x-if="item.is_image">
                                    <img :src="item.url" :alt="item.filename" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!item.is_image">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-file text-2xl text-gray-400"></i>
                                    </div>
                                </template>
                            </div>
                            {{-- Selected checkmark --}}
                            <div x-show="selectedId === item.id"
                                 class="absolute top-1.5 right-1.5 bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-xs text-gray-600 truncate px-1 py-1" x-text="item.filename"></p>
                        </div>
                    </template>
                </div>

                {{-- Load more --}}
                <div x-show="nextPageUrl" class="text-center mt-4">
                    <button @click="loadMore()" class="text-sm text-blue-600 hover:underline">
                        <i class="fas fa-chevron-down mr-1"></i> Load more
                    </button>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between flex-shrink-0 bg-gray-50 rounded-b-2xl">
                <p class="text-sm text-gray-500">
                    <span x-show="selectedId">Gambar dipilih</span>
                    <span x-show="!selectedId">Belum ada yang dipilih</span>
                </p>
                <div class="flex gap-3">
                    <button @click="close()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button @click="confirm()" :disabled="!selectedId"
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium transition disabled:opacity-40 hover:bg-blue-700">
                        Gunakan Gambar Ini
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>{{-- end x-data --}}
@endsection

@push('scripts')
<script>
function mediaPicker() {
    return {
        isOpen: false,
        loading: false,
        mediaItems: [],
        nextPageUrl: null,
        search: '',
        selectedId: null,
        selectedUrl: null,
        targetValueId: null,
        targetPreviewId: null,
        targetEmptyId: null,

        open(valueId, previewId, emptyId) {
            this.targetValueId  = valueId;
            this.targetPreviewId = previewId;
            this.targetEmptyId  = emptyId;
            this.selectedId  = null;
            this.selectedUrl = null;
            this.search = '';
            this.mediaItems = [];
            this.isOpen = true;
            this.loadMedia(1);
        },

        close() {
            this.isOpen = false;
        },

        async loadMedia(page = 1) {
            this.loading = true;
            const url = `{{ route('admin.media.index') }}?page=${page}&search=${encodeURIComponent(this.search)}`;
            const res = await fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            const json = await res.json();
            this.mediaItems = page === 1 ? json.data : [...this.mediaItems, ...json.data];
            this.nextPageUrl = json.next_page_url;
            this.loading = false;
        },

        async loadMore() {
            if (!this.nextPageUrl) return;
            const url = new URL(this.nextPageUrl);
            const page = url.searchParams.get('page');
            await this.loadMedia(page);
        },

        pick(item) {
            this.selectedId  = item.id;
            this.selectedUrl = item.url;
        },

        confirm() {
            if (!this.selectedUrl) return;

            // Set hidden input value
            const input = document.getElementById(this.targetValueId);
            if (input) input.value = this.selectedUrl;

            // Update preview image
            const preview = document.getElementById(this.targetPreviewId);
            if (preview) {
                preview.src = this.selectedUrl;
                preview.classList.remove('hidden');
            }

            // Hide "empty" placeholder
            const empty = document.getElementById(this.targetEmptyId);
            if (empty) empty.classList.add('hidden');

            this.close();
        },

        async uploadFiles(event) {
            const files = event.target.files;
            if (!files.length) return;

            const form = new FormData();
            form.append('_token', '{{ csrf_token() }}');
            for (const f of files) form.append('files[]', f);

            this.loading = true;
            await fetch('{{ route('admin.media.store') }}', { method: 'POST', body: form });
            await this.loadMedia(1);
        },
    }
}

function clearImage(valueId, previewId, emptyId) {
    document.getElementById(valueId).value = '';
    const preview = document.getElementById(previewId);
    preview.src = '';
    preview.classList.add('hidden');
    const empty = document.getElementById(emptyId);
    if (empty) empty.classList.remove('hidden');
}

// Character counters for SEO fields
document.addEventListener('DOMContentLoaded', () => {
    const titleInput = document.querySelector('[name="site_title"]');
    const titleCount = document.getElementById('title-count');
    if (titleInput && titleCount) {
        const update = () => titleCount.textContent = `${titleInput.value.length}/70`;
        update();
        titleInput.addEventListener('input', update);
    }

    const descInput = document.querySelector('[name="meta_description"]');
    const descCount = document.getElementById('desc-count');
    if (descInput && descCount) {
        const update = () => descCount.textContent = `${descInput.value.length}/160`;
        update();
        descInput.addEventListener('input', update);
    }
});
</script>
@endpush
