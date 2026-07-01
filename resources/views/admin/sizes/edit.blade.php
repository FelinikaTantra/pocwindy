@extends('layouts.admin')

@section('title', 'Edit Ukuran')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 max-w-md">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Ukuran</h2>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul class="list-disc list-inside text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.sizes.update', $size->id) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $size->name) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $size->sort_order) }}" min="0"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">Perbarui</button>
            <a href="{{ route('admin.sizes.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium transition">Batal</a>
        </div>
    </form>
</div>
@endsection
