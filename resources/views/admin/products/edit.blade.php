@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">Edit Produk</h2>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Left Column -->
            <div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk *</label>
                    <input type="text" name="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                        <select name="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                        <input type="text" name="sku" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('sku', $product->sku) }}">
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) *</label>
                        <input type="number" name="price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('price', (int)$product->price) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Coret (Rp)</label>
                        <input type="number" name="strike_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('strike_price', (int)$product->strike_price) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi *</label>
                    <textarea name="description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" required>{{ old('description', $product->description) }}</textarea>
                </div>

            </div>

            <!-- Right Column -->
            <div>
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok *</label>
                        <input type="number" name="stock" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('stock', $product->stock) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge (Opsional)</label>
                        <select name="badge" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                            <option value="">-- Tanpa Badge --</option>
                            <option value="New Arrival" {{ old('badge', $product->badge) == 'New Arrival' ? 'selected' : '' }}>New Arrival</option>
                            <option value="Best Seller" {{ old('badge', $product->badge) == 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                            <option value="Promo" {{ old('badge', $product->badge) == 'Promo' ? 'selected' : '' }}>Promo</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Warna (Pisahkan dengan koma)</label>
                    <input type="text" name="colors" placeholder="Hitam, Putih, Merah" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('colors', $product->colors ? implode(', ', $product->colors) : '') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran (Pisahkan dengan koma)</label>
                    <input type="text" name="sizes" placeholder="39, 40, 41, 42" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" value="{{ old('sizes', $product->sizes ? implode(', ', $product->sizes) : '') }}">
                </div>

                <div class="mb-4 p-4 border rounded-md bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Utama Saat Ini</label>
                    @if($product->thumbnail)
                        <img src="{{ Storage::url($product->thumbnail) }}" alt="Thumbnail" class="h-24 w-24 object-cover rounded mb-2 border">
                    @else
                        <p class="text-sm text-gray-500 mb-2">Belum ada thumbnail.</p>
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="mb-4 p-4 border rounded-md bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Tambahan Galeri Foto</label>
                    <input type="file" name="gallery[]" accept="image/*" multiple class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
            </div>

        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-2 rounded-lg font-medium transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                Perbarui Produk
            </button>
        </div>
    </form>

    <!-- Gallery Images Manager -->
    @if($product->images->count() > 0)
    <div class="mt-8 pt-8 border-t">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Kelola Galeri Foto</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($product->images as $image)
            <div class="relative group border rounded-md overflow-hidden bg-gray-100">
                <img src="{{ Storage::url($image->image_path) }}" alt="Gallery" class="h-32 w-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                    <form action="{{ route('admin.products.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
