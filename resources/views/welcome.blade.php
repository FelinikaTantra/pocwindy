<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SepatuKu - E-Catalog Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        accent: '#000000', // Premium black
                        dark: '#111111',
                    }
                }
            }
        }
    </script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glassmorphism {
            background: rgba(17, 17, 17, 0.8);
        }
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
        .product-hover {
            transition: all 0.4s ease;
        }
        .product-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body x-data="{
        darkMode: false,
        mobileMenu: false,
        activeCategory: 'all',
        modal: { open: false, productId: null, name: '', category: '', price: '', strikePrice: '', image: '', badge: '', description: '', waLink: '' },
        filterCategory(slug) {
            this.activeCategory = slug;
            document.getElementById('produk').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }" :class="{ 'dark': darkMode }" class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-white dark:bg-dark transition-colors duration-300">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-[100] glassmorphism border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center cursor-pointer">
                    <a href="/" class="text-3xl font-extrabold tracking-tighter relative z-10">Sepatu<span class="text-gray-500 dark:text-gray-400">Ku.</span></a>
                </div>
                <div class="hidden md:flex space-x-8 items-center relative z-10">
                    <a href="#home" class="text-sm font-semibold hover:text-gray-500 transition cursor-pointer">Home</a>
                    <a href="#produk" class="text-sm font-semibold hover:text-gray-500 transition cursor-pointer">Products</a>
                    <a href="#tentang" class="text-sm font-semibold hover:text-gray-500 transition cursor-pointer">About Us</a>
                    <a href="#testimoni" class="text-sm font-semibold hover:text-gray-500 transition cursor-pointer">Testimony</a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition cursor-pointer relative z-10">
                        <svg x-show="!darkMode" class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-4 relative z-10">
                    <button @click="darkMode = !darkMode" class="p-2 cursor-pointer relative z-10">
                        <svg x-show="!darkMode" class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    <button @click="mobileMenu = !mobileMenu" class="text-gray-900 dark:text-white focus:outline-none cursor-pointer relative z-10">
                        <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-cloak x-transition class="md:hidden bg-white dark:bg-dark border-b border-gray-200 dark:border-gray-800 relative z-50">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#home" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-800">Home</a>
                <a href="#produk" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-800">Products</a>
                <a href="#tentang" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-800">About Us</a>
                <a href="#testimoni" @click="mobileMenu = false" class="block px-3 py-2 text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-800">Testimony</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 hero-bg z-0 transform scale-105 hover:scale-100 transition-transform duration-1000"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
        
        <div class="relative z-20 text-center px-4 max-w-5xl mx-auto mt-20">
            <span class="block text-sm font-bold tracking-widest text-white uppercase mb-4 animate-pulse">{{ $settings['hero_subtitle'] ?? 'Koleksi Terbaru 2026' }}</span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                {!! $settings['hero_title'] ?? 'Step Into Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-200 to-gray-400">Style.</span>' !!}
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
                {{ $settings['hero_desc'] ?? 'Koleksi Sepatu Premium Berkualitas untuk menemani setiap langkah percaya diri Anda.' }}
            </p>
            <a href="#produk" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-black bg-white rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                {{ $settings['hero_btn'] ?? 'Lihat Koleksi Kami' }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-12 bg-white dark:bg-dark border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-3">
                {{-- All button --}}
                <button
                    @click="filterCategory('all')"
                    :class="activeCategory === 'all'
                        ? 'bg-gray-900 dark:bg-gray-100 text-white dark:text-black border-gray-900 dark:border-gray-100'
                        : 'border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 text-gray-700 dark:text-gray-300'"
                    class="px-6 py-2 rounded-full border font-medium transition">
                    All
                </button>
                {{-- Category buttons --}}
                @foreach($categories ?? [] as $category)
                <button
                    @click="filterCategory('{{ $category->slug }}')"
                    :class="activeCategory === '{{ $category->slug }}'
                        ? 'bg-gray-900 dark:bg-gray-100 text-white dark:text-black border-gray-900 dark:border-gray-100'
                        : 'border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 text-gray-700 dark:text-gray-300'"
                    class="px-6 py-2 rounded-full border font-medium transition">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section id="produk" class="py-20 bg-gray-50 dark:bg-[#161616]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4">{{ $settings['products_title'] ?? 'New Arrivals' }}</h2>
                    <p class="text-gray-500 dark:text-gray-400">{{ $settings['products_subtitle'] ?? 'Temukan sepatu terbaru yang dirancang khusus untuk kenyamanan dan gaya Anda.' }}</p>
                </div>
                <button @click="filterCategory('all')"
                        class="hidden md:flex items-center text-sm font-bold border-b-2 border-black dark:border-white pb-1 hover:opacity-70 transition">
                    {{ $settings['products_view_all'] ?? 'Lihat Semua' }}
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

            {{-- Active filter indicator --}}
            <div x-show="activeCategory !== 'all'" x-cloak class="flex items-center gap-2 mb-6">
                <span class="text-sm text-gray-500 dark:text-gray-400">Filter aktif:</span>
                <span class="px-3 py-1 bg-gray-900 dark:bg-gray-100 text-white dark:text-black text-xs font-bold rounded-full" x-text="activeCategory"></span>
                <button @click="filterCategory('all')" class="text-xs text-gray-400 hover:text-red-500 transition ml-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                    <div
                        x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug ?? '' }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white dark:bg-dark rounded-2xl overflow-hidden product-hover border border-gray-100 dark:border-gray-800 relative group cursor-pointer"
                        @click="modal = {
                            open: true,
                            productId: {{ $product->id }},
                            name: '{{ addslashes($product->name) }}',
                            category: '{{ addslashes($product->category->name ?? 'Uncategorized') }}',
                            price: 'Rp {{ number_format($product->price, 0, ',', '.') }}',
                            strikePrice: '{{ $product->strike_price ? 'Rp ' . number_format($product->strike_price, 0, ',', '.') : '' }}',
                            image: '{{ Str::startsWith($product->thumbnail ?? '', 'http') ? $product->thumbnail : asset('storage/' . ($product->thumbnail ?? '')) }}',
                            badge: '{{ addslashes($product->badge ?? '') }}',
                            description: '{{ addslashes($product->description) }}',
                            waLink: '{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '6281234567890') . '?text=' . urlencode('Halo, saya tertarik dengan produk ' . $product->name . ' seharga Rp ' . number_format($product->price, 0, ',', '.') . '. Mohon info stok dan harga.') }}'
                        }; trackProductView({{ $product->id }})">
                        @if($product->badge)
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $product->badge }}</span>
                        </div>
                        @endif
                        <div class="h-64 overflow-hidden relative bg-gray-100 dark:bg-gray-800">
                            @if($product->thumbnail)
                                <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @elseif($product->images && $product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if($product->strike_price)
                                <span class="text-sm text-gray-400 line-through">Rp {{ number_format($product->strike_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500 py-10">Belum ada produk.</div>
                @endif
            </div>

            {{-- Empty state when filter yields no results --}}
            <div x-cloak class="col-span-full text-center py-16 text-gray-400"
                 x-show="activeCategory !== 'all' && document.querySelectorAll('#produk [x-show]:not([style*=\'none\'])').length === 0">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm">Belum ada produk di kategori ini.</p>
                <button @click="filterCategory('all')" class="mt-3 text-sm text-blue-600 hover:underline">Lihat semua produk</button>
            </div>

            <div class="mt-8 text-center md:hidden">
                <button @click="filterCategory('all')"
                        class="inline-flex items-center text-sm font-bold border-b-2 border-black dark:border-white pb-1 hover:opacity-70 transition">
                    {{ $settings['products_view_all'] ?? 'Lihat Semua' }}
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-24 bg-white dark:bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2">
                    <div class="relative h-96 md:h-[500px] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1556906781-9a412961c28c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tentang Kami" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <span class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 block">{{ $settings['about_subtitle'] ?? 'Tentang Perusahaan' }}</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">{{ $settings['about_title'] ?? 'Berjalan Lebih Jauh dengan Kualitas Terbaik.' }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg leading-relaxed">
                        {{ $settings['about_desc'] ?? 'Kami adalah pelopor dalam industri alas kaki premium. Berdiri sejak 2010, SepatuKu berkomitmen untuk tidak hanya sekadar menjual sepatu, tetapi memberikan pengalaman melangkah yang tak terlupakan.' }}
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="text-4xl font-extrabold mb-2 text-black dark:text-white">{{ $settings['about_stat_1_val'] ?? '50k+' }}</h4>
                            <p class="text-gray-500 text-sm font-semibold">{{ $settings['about_stat_1_label'] ?? 'Pelanggan Puas' }}</p>
                        </div>
                        <div>
                            <h4 class="text-4xl font-extrabold mb-2 text-black dark:text-white">{{ $settings['about_stat_2_val'] ?? '100%' }}</h4>
                            <p class="text-gray-500 text-sm font-semibold">{{ $settings['about_stat_2_label'] ?? 'Original & Garansi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-gray-50 dark:bg-[#161616]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
            <span class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 block">Review</span>
            <h2 class="text-3xl md:text-4xl font-extrabold">Apa Kata Mereka?</h2>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white dark:bg-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 relative">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium italic">"Kualitas sepatu sangat memuaskan. Bahannya premium dan sangat nyaman dipakai seharian untuk lari maupun jalan santai!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="Budi" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Budi Santoso</h4>
                            <p class="text-xs text-gray-500">Karyawan Swasta</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white dark:bg-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 relative">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium italic">"Pengiriman sangat cepat dan adminnya sangat responsif. Sepatunya pas banget ukurannya. Recommended seller!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Aisyah&background=random" alt="Siti" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Siti Aisyah</h4>
                            <p class="text-xs text-gray-500">Mahasiswi</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white dark:bg-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 relative">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium italic">"Model sepatu selalu update dan kekinian. Desain tokonya juga kelihatan premium banget. Auto jadi langganan!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Agus+Pratama&background=random" alt="Agus" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Agus Pratama</h4>
                            <p class="text-xs text-gray-500">Pengusaha</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Buttons -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
        <!-- Instagram -->
        <a href="#" class="w-12 h-12 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-500 rounded-full flex items-center justify-center text-white shadow-lg transform hover:scale-110 transition duration-300">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </a>
        <!-- TikTok -->
        <a href="#" class="w-12 h-12 bg-black dark:bg-gray-800 rounded-full flex items-center justify-center text-white shadow-lg transform hover:scale-110 transition duration-300">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
        </a>
        <!-- WhatsApp Floating with Pulse -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '6281234567890') }}?text={{ urlencode('Halo, saya tertarik dengan produk sepatu Anda') }}" target="_blank" class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white shadow-xl transform hover:scale-110 transition duration-300 animate-bounce relative">
            <svg class="w-8 h-8 z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <div class="absolute inset-0 rounded-full border-2 border-green-500 animate-ping"></div>
        </a>
    </div>

    <!-- Sticky Mobile CTA -->
    <div class="fixed bottom-0 left-0 w-full bg-white dark:bg-dark border-t border-gray-200 dark:border-gray-800 p-4 z-40 md:hidden flex justify-between items-center">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Punya pertanyaan?</p>
            <p class="font-bold text-sm">Hubungi CS Kami</p>
        </div>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '6281234567890') }}" class="bg-black dark:bg-white text-white dark:text-black px-6 py-2 rounded-full font-bold text-sm">
            Pesan Sekarang
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-dark pt-16 pb-24 md:pb-8 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-extrabold tracking-tighter mb-4 block">{{ $settings['brand_name'] ?? 'SepatuKu' }}.</span>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm">{{ $settings['footer_tagline'] ?? 'Toko sepatu premium dengan kualitas terbaik. Menghadirkan berbagai pilihan gaya untuk menemani setiap langkah Anda.' }}</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">{{ $settings['footer_contact_title'] ?? 'Kontak' }}</h4>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li>{{ $settings['footer_address'] ?? 'Jl. Sudirman No. 123, Jakarta' }}</li>
                        <li>{{ $settings['footer_phone'] ?? '0812-3456-7890' }}</li>
                        <li>{{ $settings['footer_email'] ?? 'hello@sepatuku.com' }}</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-8 border-t border-gray-100 dark:border-gray-800 text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ $settings['brand_name'] ?? 'SepatuKu' }}. {{ $settings['footer_copyright'] ?? 'All rights reserved.' }}
            </div>
        </div>
    </footer>

    <!-- Product Detail Modal -->
    <div 
        x-show="modal.open" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="modal.open = false"
        class="fixed inset-0 z-[999] flex items-center justify-center p-4"
        style="background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);"
    >
        <!-- Backdrop click to close -->
        <div class="absolute inset-0" @click="modal.open = false"></div>

        <!-- Modal Panel -->
        <div 
            x-show="modal.open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative bg-white dark:bg-[#111] rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden z-10"
        >
            <!-- Close Button -->
            <button 
                @click="modal.open = false"
                class="absolute top-4 right-4 z-20 w-9 h-9 flex items-center justify-center rounded-full bg-black bg-opacity-20 hover:bg-opacity-40 text-white transition"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="relative w-full md:w-1/2 h-64 md:h-auto bg-gray-100 dark:bg-gray-800 flex-shrink-0">
                    <!-- Badge -->
                    <template x-if="modal.badge">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider" x-text="modal.badge"></span>
                        </div>
                    </template>
                    <img 
                        :src="modal.image" 
                        :alt="modal.name"
                        class="w-full h-full object-cover"
                        x-show="modal.image"
                    >
                    <div x-show="!modal.image" class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                </div>

                <!-- Info Section -->
                <div class="flex flex-col justify-between p-8 w-full">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" x-text="modal.category"></p>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3 leading-tight" x-text="modal.name"></h2>

                        <!-- Price -->
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-2xl font-extrabold text-gray-900 dark:text-white" x-text="modal.price"></span>
                            <template x-if="modal.strikePrice">
                                <span class="text-base text-gray-400 line-through" x-text="modal.strikePrice"></span>
                            </template>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100 dark:border-gray-800 mb-4"></div>

                        <!-- Description -->
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed" x-text="modal.description"></p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col gap-3 mt-6">
                        <a 
                            :href="modal.waLink"
                            target="_blank"
                            @click="trackWaClick(modal.productId, modal.name, modal.waLink)"
                            class="flex items-center justify-center gap-2 w-full py-3 px-6 bg-green-500 hover:bg-green-600 text-white font-bold rounded-2xl transition transform hover:scale-105"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Pesan via WhatsApp
                        </a>
                        <button 
                            @click="modal.open = false"
                            class="w-full py-3 px-6 border-2 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-2xl hover:border-gray-400 transition"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         LEAD POPUP — muncul 15 detik setelah halaman dibuka
         atau saat scroll 60% ke bawah
    ═══════════════════════════════════════════════════════════ --}}
    <div id="lead-popup"
         class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-4 hidden"
         style="background: rgba(0,0,0,0.55); backdrop-filter: blur(4px);">

        <div id="lead-popup-box"
             class="bg-white dark:bg-[#111] rounded-3xl shadow-2xl w-full max-w-md overflow-hidden
                    transform translate-y-8 opacity-0 transition-all duration-300">

            {{-- Close button --}}
            <button onclick="closeLeadPopup()"
                    class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:bg-gray-200 transition z-10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Header banner --}}
            <div class="bg-gradient-to-r from-gray-900 to-gray-700 px-6 py-5 relative">
                <div class="absolute inset-0 opacity-10"
                     style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&q=60'); background-size: cover; background-position: center;"></div>
                <div class="relative">
                    <span class="text-xs font-bold text-green-400 uppercase tracking-widest mb-1 block">Katalog Terbaru</span>
                    <h3 class="text-xl font-extrabold text-white">Mau lihat koleksi lengkapnya?</h3>
                    <p class="text-gray-300 text-sm mt-1">Masukkan nomor WA dan kami kirimkan katalog langsung ke chat kamu.</p>
                </div>
            </div>

            {{-- Form --}}
            <div class="p-6">
                <div id="lead-form-state">
                    <div class="space-y-3 mb-4">
                        <div>
                            <input type="text" id="lead-name" placeholder="Nama kamu"
                                   class="w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <input type="tel" id="lead-wa" placeholder="Nomor WhatsApp (08...)"
                                   class="w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div id="lead-error" class="hidden text-red-500 text-xs px-1"></div>
                    </div>

                    <button onclick="submitLead()"
                            class="w-full py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl flex items-center justify-center gap-2 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Kirim Katalog ke WA Saya
                    </button>
                </div>

                {{-- Success state --}}
                <div id="lead-success-state" class="hidden text-center py-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-1">Terima kasih!</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400" id="lead-success-msg">Kami akan segera menghubungi kamu via WhatsApp.</p>
                </div>

                <p class="text-center text-xs text-gray-400 mt-3">
                    Tidak mau? <button onclick="closeLeadPopup()" class="underline hover:text-gray-600">Lewati saja</button>
                </p>
            </div>
        </div>
    </div>

    {{-- Toast notification --}}
    <div id="toast"
         class="fixed bottom-24 md:bottom-6 left-1/2 -translate-x-1/2 z-[9998]
                bg-gray-900 text-white text-sm px-5 py-3 rounded-full shadow-xl
                opacity-0 pointer-events-none transition-all duration-300 whitespace-nowrap">
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         TRACKING + LEAD SCRIPTS
    ═══════════════════════════════════════════════════════════ --}}
    <script>
    // ── Session ID (persisted in sessionStorage) ──────────────────
    const SESSION_ID = (() => {
        let id = sessionStorage.getItem('_sid');
        if (!id) {
            id = Math.random().toString(36).slice(2) + Date.now().toString(36);
            sessionStorage.setItem('_sid', id);
        }
        return id;
    })();

    const CSRF = '{{ csrf_token() }}';

    // ── Post helper ───────────────────────────────────────────────
    function post(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ ...data, session_id: SESSION_ID }),
        }).catch(() => {}); // silent fail — tracking should never break UX
    }

    // ── 1. Page view tracking ─────────────────────────────────────
    post('{{ route('track.pageview') }}', { url: window.location.href });

    // ── 2. Product view tracking (called from Alpine @click) ──────
    function trackProductView(productId) {
        post('{{ route('track.product') }}', { product_id: productId });
    }

    // ── 3. WA click tracking (called from Alpine @click) ──────────
    function trackWaClick(productId, productName, waLink) {
        post('{{ route('track.whatsapp') }}', {
            product_id:    productId,
            product_name:  productName,
            referrer_page: window.location.href,
        });
        // Navigation handled by the <a> tag's href — no redirect needed here
    }

    // ── 4. Lead popup logic ───────────────────────────────────────
    let popupShown = false;

    function showLeadPopup() {
        if (popupShown) return;
        // Don't show if already submitted this session
        if (sessionStorage.getItem('_lead_done')) return;
        popupShown = true;

        const popup = document.getElementById('lead-popup');
        const box   = document.getElementById('lead-popup-box');
        popup.classList.remove('hidden');
        // Trigger animation next frame
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                box.classList.remove('translate-y-8', 'opacity-0');
                box.classList.add('translate-y-0', 'opacity-100');
            });
        });
    }

    function closeLeadPopup() {
        const popup = document.getElementById('lead-popup');
        const box   = document.getElementById('lead-popup-box');
        box.classList.remove('translate-y-0', 'opacity-100');
        box.classList.add('translate-y-8', 'opacity-0');
        setTimeout(() => popup.classList.add('hidden'), 300);
    }

    // Show after 15 seconds
    setTimeout(showLeadPopup, 15000);

    // Also show after 60% scroll depth
    window.addEventListener('scroll', () => {
        const scrolled = (window.scrollY + window.innerHeight) / document.body.scrollHeight;
        if (scrolled >= 0.6) showLeadPopup();
    }, { passive: true });

    // Close on backdrop click
    document.getElementById('lead-popup').addEventListener('click', function(e) {
        if (e.target === this) closeLeadPopup();
    });

    // ── 5. Lead form submit ───────────────────────────────────────
    // Track which product was being viewed when popup shown
    let lastViewedProductId   = null;
    let lastViewedProductName = null;

    // Alpine dispatches this when product modal opens
    document.addEventListener('alpine:initialized', () => {
        document.addEventListener('product-viewed', (e) => {
            lastViewedProductId   = e.detail.id;
            lastViewedProductName = e.detail.name;
        });
    });

    async function submitLead() {
        const name = document.getElementById('lead-name').value.trim();
        const wa   = document.getElementById('lead-wa').value.trim();
        const err  = document.getElementById('lead-error');

        // Basic validation
        if (!name) { showError('Nama tidak boleh kosong.'); return; }
        if (!wa || wa.length < 9) { showError('Nomor WhatsApp tidak valid.'); return; }

        err.classList.add('hidden');

        try {
            const res = await post('{{ route('lead.submit') }}', {
                name:          name,
                whatsapp:      wa,
                product_id:    lastViewedProductId,
                product_name:  lastViewedProductName,
                referrer_page: window.location.href,
                source:        'lead_form',
            });

            const json = await res.json();

            if (json.ok) {
                sessionStorage.setItem('_lead_done', '1');
                document.getElementById('lead-form-state').classList.add('hidden');
                document.getElementById('lead-success-state').classList.remove('hidden');
                document.getElementById('lead-success-msg').textContent = json.message ?? 'Kami akan segera menghubungi kamu via WhatsApp.';
                setTimeout(closeLeadPopup, 3000);
            } else {
                showError('Terjadi kesalahan. Coba lagi.');
            }
        } catch (e) {
            showError('Koneksi bermasalah. Coba lagi.');
        }
    }

    function showError(msg) {
        const el = document.getElementById('lead-error');
        el.textContent = msg;
        el.classList.remove('hidden');
    }

    // ── 6. Toast helper ───────────────────────────────────────────
    function showToast(msg, duration = 2500) {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.classList.remove('opacity-0');
        t.classList.add('opacity-100');
        setTimeout(() => {
            t.classList.remove('opacity-100');
            t.classList.add('opacity-0');
        }, duration);
    }
    </script>

</body>
</html>
