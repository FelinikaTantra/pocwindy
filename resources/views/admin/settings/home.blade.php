@extends('layouts.admin')

@section('title', 'Homepage Settings')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.home.update') }}" method="POST">
        @csrf

        <h3 class="text-xl font-bold mb-4">Hero Section</h3>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Subtitle</label>
            <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Koleksi Terbaru 2026') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Title</label>
            <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Step Into Your Style.') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Description</label>
            <textarea name="hero_desc" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('hero_desc', $settings['hero_desc'] ?? 'Koleksi Sepatu Premium Berkualitas untuk menemani setiap langkah percaya diri Anda.') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Button Text</label>
            <input type="text" name="hero_btn" value="{{ old('hero_btn', $settings['hero_btn'] ?? 'Lihat Koleksi Kami') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-bold mb-4">Products Section</h3>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Section Title</label>
            <input type="text" name="products_title" value="{{ old('products_title', $settings['products_title'] ?? 'New Arrivals') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Section Subtitle</label>
            <input type="text" name="products_subtitle" value="{{ old('products_subtitle', $settings['products_subtitle'] ?? 'Temukan sepatu terbaru yang dirancang khusus untuk kenyamanan dan gaya Anda.') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">View All Button Text</label>
            <input type="text" name="products_view_all" value="{{ old('products_view_all', $settings['products_view_all'] ?? 'Lihat Semua') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-bold mb-4">About Section (Tentang Kami)</h3>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">About Subtitle</label>
            <input type="text" name="about_subtitle" value="{{ old('about_subtitle', $settings['about_subtitle'] ?? 'Tentang Perusahaan') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">About Title</label>
            <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? 'Berjalan Lebih Jauh dengan Kualitas Terbaik.') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">About Description</label>
            <textarea name="about_desc" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('about_desc', $settings['about_desc'] ?? 'Kami adalah pelopor dalam industri alas kaki premium. Berdiri sejak 2010, SepatuKu berkomitmen untuk tidak hanya sekadar menjual sepatu, tetapi memberikan pengalaman melangkah yang tak terlupakan.') }}</textarea>
        </div>

        <div class="flex gap-4 mb-6">
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stat 1 Value</label>
                <input type="text" name="about_stat_1_val" value="{{ old('about_stat_1_val', $settings['about_stat_1_val'] ?? '50k+') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stat 1 Label</label>
                <input type="text" name="about_stat_1_label" value="{{ old('about_stat_1_label', $settings['about_stat_1_label'] ?? 'Pelanggan Puas') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stat 2 Value</label>
                <input type="text" name="about_stat_2_val" value="{{ old('about_stat_2_val', $settings['about_stat_2_val'] ?? '100%') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stat 2 Label</label>
                <input type="text" name="about_stat_2_label" value="{{ old('about_stat_2_label', $settings['about_stat_2_label'] ?? 'Original & Garansi') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-bold mb-4">Brand & Identity</h3>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Brand Name</label>
            <input type="text" name="brand_name" value="{{ old('brand_name', $settings['brand_name'] ?? 'SepatuKu') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-400 mt-1">Dipakai di Navbar, Footer, dan copyright.</p>
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-bold mb-4">Footer</h3>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Footer Tagline</label>
            <textarea name="footer_tagline" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('footer_tagline', $settings['footer_tagline'] ?? 'Toko sepatu premium dengan kualitas terbaik. Menghadirkan berbagai pilihan gaya untuk menemani setiap langkah Anda.') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Kolom Kontak</label>
            <input type="text" name="footer_contact_title" value="{{ old('footer_contact_title', $settings['footer_contact_title'] ?? 'Kontak') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <input type="text" name="footer_address" value="{{ old('footer_address', $settings['footer_address'] ?? 'Jl. Sudirman No. 123, Jakarta') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
            <input type="text" name="footer_phone" value="{{ old('footer_phone', $settings['footer_phone'] ?? '0812-3456-7890') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="footer_email" value="{{ old('footer_email', $settings['footer_email'] ?? 'hello@sepatuku.com') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Teks Copyright</label>
            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright'] ?? 'All rights reserved.') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-bold mb-4">WhatsApp</h3>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor WhatsApp (format internasional, tanpa +)</label>
            <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '6281234567890') }}" placeholder="6281234567890" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-400 mt-1">Contoh: 6281234567890 (62 = kode negara Indonesia, tanpa 0 di depan)</p>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
