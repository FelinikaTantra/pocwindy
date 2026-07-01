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
        <div class="bg-gray-900 shadow-xl h-auto md:h-screen w-full md:w-64 fixed z-10 hidden md:flex flex-col" id="sidebar">
            <div class="px-5 py-5 text-white text-xl font-bold border-b border-gray-700 flex items-center gap-2 flex-shrink-0">
                <i class="fas fa-shoe-prints text-blue-400"></i>
                <span>E-Catalog CMS</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-3 px-2 space-y-1" style="scrollbar-width: thin; scrollbar-color: #4b5563 transparent;">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-chart-line w-4 text-center"></i> Dashboard
                </a>

                {{-- CATALOG --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Catalog</p>
                </div>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-shoe-prints w-4 text-center"></i> Products
                </a>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-folder w-4 text-center"></i> Categories
                </a>
                <a href="{{ route('admin.sizes.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.sizes.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-ruler w-4 text-center"></i> Sizes
                </a>
                <a href="{{ route('admin.colors.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.colors.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-palette w-4 text-center"></i> Colors
                </a>

                {{-- CONTENT --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</p>
                </div>
                <a href="{{ route('admin.media.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.media.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-images w-4 text-center"></i> Media Library
                </a>

                {{-- APPEARANCE --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Appearance</p>
                </div>
                <a href="{{ route('admin.settings.home') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.settings.home') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-home w-4 text-center"></i> Homepage Settings
                </a>
                <a href="{{ route('admin.theme.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.theme.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-paint-roller w-4 text-center"></i> Theme Customizer
                </a>

                {{-- LEADS --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Leads</p>
                </div>
                <a href="{{ route('admin.leads.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.leads.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-plus w-4 text-center"></i> Leads
                    @php $newLeadCount = \App\Models\Lead::where('status','new')->count(); @endphp
                    @if($newLeadCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 leading-none">{{ $newLeadCount }}</span>
                    @endif
                </a>

                {{-- ADMINISTRATION --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Administration</p>
                </div>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-users w-4 text-center"></i> Users
                </a>

                {{-- SETTINGS --}}
                <div class="pt-3 pb-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Settings</p>
                </div>
                <a href="{{ route('admin.settings.general') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.settings.general') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-cog w-4 text-center"></i> General Settings
                </a>

            </nav>

            {{-- Bottom: catalog PDF --}}
            <div class="border-t border-gray-700 px-3 py-3 flex-shrink-0">
                <a href="{{ route('admin.catalog.pdf') }}" target="_blank"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-400 hover:bg-gray-700 hover:text-white transition">
                    <i class="fas fa-file-pdf w-4 text-center"></i> Export PDF Catalog
                </a>
            </div>
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
