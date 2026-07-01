@extends('layouts.admin')

@section('title', 'Tambah Warna')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 max-w-md">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Warna</h2>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul class="list-disc list-inside text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.colors.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Warna <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Hitam, Merah, Navy..." required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hex Code</label>
            <div class="flex gap-2 items-center">
                <input type="color" id="color_picker" value="{{ old('hex_code', '#000000') }}"
                       class="h-10 w-14 rounded border border-gray-300 cursor-pointer p-1">
                <input type="text" name="hex_code" id="hex_input" value="{{ old('hex_code') }}"
                       placeholder="#000000" maxlength="7"
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <p class="text-xs text-gray-500 mt-1">Format: #RRGGBB (opsional)</p>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">Simpan</button>
            <a href="{{ route('admin.colors.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium transition">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const picker = document.getElementById('color_picker');
    const hexInput = document.getElementById('hex_input');
    picker.addEventListener('input', () => { hexInput.value = picker.value; });
    hexInput.addEventListener('input', () => {
        if (/^#[0-9A-Fa-f]{6}$/.test(hexInput.value)) picker.value = hexInput.value;
    });
</script>
@endpush
@endsection
