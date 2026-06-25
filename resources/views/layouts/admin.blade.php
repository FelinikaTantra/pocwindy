<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 shadow-xl h-auto md:h-screen w-full md:w-64 fixed z-10 hidden md:block" id="sidebar">
            <div class="p-6 text-white text-2xl font-bold border-b border-gray-700">
                E-Catalog CMS
            </div>
            <ul class="list-reset flex flex-col md:flex-col py-4 px-2 text-center md:text-left">
                <li class="mr-3 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}"><i class="fas fa-home w-5"></i> Dashboard</a>
                    <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}"><i class="fas fa-folder w-5"></i> Kategori</a>
                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-gray-700 text-white' : '' }}"><i class="fas fa-box w-5"></i> Produk</a>
                    <a href="{{ route('admin.pages.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg {{ request()->routeIs('admin.pages.*') ? 'bg-gray-700 text-white' : '' }}"><i class="fas fa-file-alt w-5"></i> Pages</a>
                    <a href="{{ route('admin.theme.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg {{ request()->routeIs('admin.theme.*') ? 'bg-gray-700 text-white' : '' }}"><i class="fas fa-paint-roller w-5"></i> Theme Customizer</a>
                </li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 md:ml-64 flex flex-col">
            <!-- Topbar -->
            <div class="bg-white shadow h-16 flex items-center justify-between px-6 z-10 w-full">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Logout</button>
                    </form>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="p-6 overflow-y-auto bg-gray-100 flex-1">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
