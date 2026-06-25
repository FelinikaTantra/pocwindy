<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->meta_title ?? $page->title }} - E-Catalog</title>
    @if($page->meta_description)
    <meta name="description" content="{{ $page->meta_description }}">
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Dynamic Theme Injection -->
    <style>
        :root {
            --primary-color: {{ $themeSettings['primary_color'] ?? '#3b82f6' }};
            --secondary-color: {{ $themeSettings['secondary_color'] ?? '#1f2937' }};
            --border-radius: {{ $themeSettings['border_radius'] ?? '0.5rem' }};
        }
        
        body {
            font-family: {!! $themeSettings['font_family'] ?? "'Inter', sans-serif" !!};
        }
        
        .theme-primary-bg { background-color: var(--primary-color); }
        .theme-primary-text { color: var(--primary-color); }
        .theme-secondary-bg { background-color: var(--secondary-color); }
        .theme-secondary-text { color: var(--secondary-color); }
        .theme-rounded { border-radius: var(--border-radius); }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    
    <!-- Temporary Header (to be replaced by Menu Builder later) -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold theme-primary-text">E-Catalog</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <!-- Dynamic navigation will go here -->
                    <a href="/" class="text-gray-900 inline-flex items-center px-1 pt-1 font-medium hover:theme-primary-text">Home</a>
                    <a href="/login" class="text-gray-500 inline-flex items-center px-1 pt-1 font-medium hover:theme-primary-text">Admin</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @foreach($page->blocks as $block)
            @if($block->type === 'hero')
                <div class="relative theme-secondary-bg">
                    <div class="absolute inset-0">
                        @if(!empty($block->settings['image_url']))
                        <img class="w-full h-full object-cover opacity-30" src="{{ $block->settings['image_url'] }}" alt="">
                        @endif
                    </div>
                    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
                        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $block->settings['headline'] ?? '' }}</h1>
                        <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto">{{ $block->settings['subheadline'] ?? '' }}</p>
                    </div>
                </div>
            @elseif($block->type === 'text')
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 prose prose-lg text-gray-700">
                    {{ $block->settings['content'] ?? '' }}
                </div>
            @elseif($block->type === 'product_grid')
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    @if(!empty($block->settings['title']))
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">{{ $block->settings['title'] }}</h2>
                    @endif
                    
                    @php
                        // Dynamically fetch products
                        $limit = $block->settings['limit'] ?? 8;
                        $products = App\Models\Product::where('is_active', true)->take($limit)->get();
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                        <div class="bg-white shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition theme-rounded">
                            @if($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2 truncate">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <div class="font-bold theme-primary-text">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </main>

    <footer class="bg-white mt-12 border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            &copy; {{ date('Y') }} E-Catalog. All rights reserved.
        </div>
    </footer>
</body>
</html>
