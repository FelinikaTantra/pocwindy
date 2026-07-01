@extends('layouts.admin')

@section('title', 'Ukuran Sepatu')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Ukuran</h2>
        <a href="{{ route('admin.sizes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            + Tambah Ukuran
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ukuran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urutan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($sizes as $size)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration + $sizes->firstItem() - 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $size->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $size->sort_order }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="{{ route('admin.sizes.edit', $size->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus ukuran ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada ukuran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $sizes->links() }}</div>
</div>
@endsection
