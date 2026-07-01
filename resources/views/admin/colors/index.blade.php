@extends('layouts.admin')

@section('title', 'Warna Produk')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Warna</h2>
        <a href="{{ route('admin.colors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            + Tambah Warna
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Warna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hex Code</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($colors as $color)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration + $colors->firstItem() - 1 }}</td>
                    <td class="px-6 py-4">
                        @if($color->hex_code)
                            <div class="h-8 w-8 rounded-full border border-gray-300 shadow-inner"
                                 style="background-color: {{ $color->hex_code }}"></div>
                        @else
                            <div class="h-8 w-8 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center text-gray-400 text-xs">?</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $color->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $color->hex_code ?? '—' }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="{{ route('admin.colors.edit', $color->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus warna ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada warna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $colors->links() }}</div>
</div>
@endsection
