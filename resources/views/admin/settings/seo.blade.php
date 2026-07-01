@extends('layouts.admin')

@section('title', 'SEO Settings')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-800 mb-2">SEO Settings</h2>
    <p class="text-sm text-gray-500 mb-6">Pengaturan default SEO untuk website. Bisa di-override per halaman.</p>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.seo.update') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Basic Meta --}}
        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Meta Tags</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}"
                           maxlength="70"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">Maks 70 karakter. Tampil di tab browser dan hasil pencarian.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3" maxlength="160"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">Maks 160 karakter. Tampil di snippet hasil pencarian Google.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}"
                           placeholder="sepatu, sneakers, olahraga, ..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma.</p>
                </div>
            </div>
        </div>

        {{-- Open Graph --}}
        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Open Graph (Social Media)</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Title</label>
                    <input type="text" name="og_title" value="{{ old('og_title', $settings['og_title'] ?? '') }}"
                           maxlength="70"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Description</label>
                    <textarea name="og_description" rows="2" maxlength="200"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('og_description', $settings['og_description'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OG Image URL</label>
                    <input type="text" name="og_image" value="{{ old('og_image', $settings['og_image'] ?? '') }}"
                           placeholder="https://..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">Gambar yang tampil saat link dibagikan di WhatsApp, Facebook, dll. Ukuran ideal: 1200×630px.</p>
                </div>
            </div>
        </div>

        {{-- Analytics --}}
        <div class="pb-2">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Analytics & Tracking</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Google Analytics ID</label>
                    <input type="text" name="google_analytics" value="{{ old('google_analytics', $settings['google_analytics'] ?? '') }}"
                           placeholder="G-XXXXXXXXXX"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Google Tag Manager ID</label>
                    <input type="text" name="google_tag" value="{{ old('google_tag', $settings['google_tag'] ?? '') }}"
                           placeholder="GTM-XXXXXXX"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
            Simpan SEO Settings
        </button>
    </form>
</div>
@endsection
