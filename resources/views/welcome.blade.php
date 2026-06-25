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
<body x-data="{ darkMode: false, mobileMenu: false }" :class="{ 'dark': darkMode }" class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-white dark:bg-dark transition-colors duration-300">

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
            <span class="block text-sm font-bold tracking-widest text-white uppercase mb-4 animate-pulse">Koleksi Terbaru 2026</span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                Step Into Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-200 to-gray-400">Style.</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
                Koleksi Sepatu Premium Berkualitas untuk menemani setiap langkah percaya diri Anda.
            </p>
            <a href="#produk" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-black bg-white rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                Lihat Koleksi Kami
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-12 bg-white dark:bg-dark border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="px-6 py-2 rounded-full border border-gray-900 dark:border-gray-100 bg-gray-900 dark:bg-gray-100 text-white dark:text-black font-medium transition">All</button>
                <button class="px-6 py-2 rounded-full border border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 font-medium transition">Sneakers</button>
                <button class="px-6 py-2 rounded-full border border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 font-medium transition">Running</button>
                <button class="px-6 py-2 rounded-full border border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 font-medium transition">Casual</button>
                <button class="px-6 py-2 rounded-full border border-gray-300 dark:border-gray-700 hover:border-gray-900 dark:hover:border-gray-100 font-medium transition">Formal</button>
            </div>
        </div>
    </section>

    <!-- Product Section (Dummy Data) -->
    <section id="produk" class="py-20 bg-gray-50 dark:bg-[#161616]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4">New Arrivals</h2>
                    <p class="text-gray-500 dark:text-gray-400">Temukan sepatu terbaru yang dirancang khusus untuk kenyamanan dan gaya Anda.</p>
                </div>
                <a href="#" class="hidden md:flex items-center text-sm font-bold border-b-2 border-black dark:border-white pb-1">
                    Lihat Semua <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Product Card 1 -->
                <div class="bg-white dark:bg-dark rounded-2xl overflow-hidden product-hover border border-gray-100 dark:border-gray-800 relative group cursor-pointer">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">New</span>
                    </div>
                    <div class="h-64 overflow-hidden relative bg-gray-100 dark:bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Sepatu 1" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Sneakers</p>
                        <h3 class="text-lg font-bold mb-2">Nike Air Max Pro</h3>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xl">Rp 1.500.000</span>
                            <span class="text-sm text-gray-400 line-through">Rp 1.800.000</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white dark:bg-dark rounded-2xl overflow-hidden product-hover border border-gray-100 dark:border-gray-800 relative group cursor-pointer">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Promo</span>
                    </div>
                    <div class="h-64 overflow-hidden relative bg-gray-100 dark:bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Sepatu 2" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Running</p>
                        <h3 class="text-lg font-bold mb-2">Puma Velocity Nitro</h3>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xl">Rp 1.200.000</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white dark:bg-dark rounded-2xl overflow-hidden product-hover border border-gray-100 dark:border-gray-800 relative group cursor-pointer">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Best Seller</span>
                    </div>
                    <div class="h-64 overflow-hidden relative bg-gray-100 dark:bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Sepatu 3" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Casual</p>
                        <h3 class="text-lg font-bold mb-2">Vans Old Skool</h3>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xl">Rp 899.000</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-white dark:bg-dark rounded-2xl overflow-hidden product-hover border border-gray-100 dark:border-gray-800 relative group cursor-pointer">
                    <div class="h-64 overflow-hidden relative bg-gray-100 dark:bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Sepatu 4" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Sneakers</p>
                        <h3 class="text-lg font-bold mb-2">Nike Air Force 1</h3>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xl">Rp 1.649.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="#" class="inline-flex items-center text-sm font-bold border-b-2 border-black dark:border-white pb-1">
                    Lihat Semua <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
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
                    <span class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 block">Tentang Perusahaan</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">Berjalan Lebih Jauh dengan Kualitas Terbaik.</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg leading-relaxed">
                        Kami adalah pelopor dalam industri alas kaki premium. Berdiri sejak 2010, SepatuKu berkomitmen untuk tidak hanya sekadar menjual sepatu, tetapi memberikan pengalaman melangkah yang tak terlupakan.
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="text-4xl font-extrabold mb-2 text-black dark:text-white">50k+</h4>
                            <p class="text-gray-500 text-sm font-semibold">Pelanggan Puas</p>
                        </div>
                        <div>
                            <h4 class="text-4xl font-extrabold mb-2 text-black dark:text-white">100%</h4>
                            <p class="text-gray-500 text-sm font-semibold">Original & Garansi</p>
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
        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20sepatu%20Anda" target="_blank" class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white shadow-xl transform hover:scale-110 transition duration-300 animate-bounce relative">
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
        <a href="https://wa.me/6281234567890" class="bg-black dark:bg-white text-white dark:text-black px-6 py-2 rounded-full font-bold text-sm">
            Pesan Sekarang
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-dark pt-16 pb-24 md:pb-8 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-extrabold tracking-tighter mb-4 block">Sepatu<span class="text-gray-500 dark:text-gray-400">Ku.</span></span>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm">Toko sepatu premium dengan kualitas terbaik. Menghadirkan berbagai pilihan gaya untuk menemani setiap langkah Anda.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li>Jl. Sudirman No. 123, Jakarta</li>
                        <li>0812-3456-7890</li>
                        <li>hello@sepatuku.com</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-8 border-t border-gray-100 dark:border-gray-800 text-sm text-gray-500">
                &copy; {{ date('Y') }} SepatuKu. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
