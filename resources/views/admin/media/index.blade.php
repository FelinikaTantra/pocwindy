@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl font-bold text-gray-800">Media Library</h2>
        <button onclick="document.getElementById('upload-form').classList.toggle('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            + Upload File
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">{{ session('error') }}</div>
    @endif

    {{-- Upload Form --}}
    <div id="upload-form" class="hidden bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-6 mb-6">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500">Upload gambar atau file (maks 5 MB per file, maks 10 file sekaligus)</p>
                <p class="text-xs text-gray-400">JPG, PNG, GIF, WebP, SVG, PDF</p>
            </div>
            <input type="file" name="files[]" multiple accept="image/*,.pdf"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4">
            @error('files.*')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <div class="flex gap-3 justify-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Upload
                </button>
                <button type="button" onclick="document.getElementById('upload-form').classList.add('hidden')"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium transition">
                    Batal
                </button>
            </div>
        </form>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.media.index') }}" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama file..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.media.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">Reset</a>
            @endif
        </div>
    </form>

    {{-- Grid --}}
    @if($media->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <i class="fas fa-images text-5xl mb-4"></i>
            <p>Belum ada file di media library.</p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($media as $item)
            <div class="group relative bg-gray-100 rounded-lg overflow-hidden border border-gray-200 hover:border-blue-400 transition"
                 x-data="{ showModal: false }">
                {{-- Thumbnail --}}
                @if($item->isImage())
                    <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->alt ?? $item->filename }}"
                         class="w-full h-28 object-cover">
                @else
                    <div class="w-full h-28 flex items-center justify-center bg-gray-200">
                        <i class="fas fa-file-pdf text-3xl text-red-400"></i>
                    </div>
                @endif

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                    @if($item->isImage())
                    <a href="{{ asset('storage/' . $item->path) }}" target="_blank"
                       class="bg-white text-gray-800 rounded-full p-1.5 hover:bg-gray-100 transition" title="Lihat">
                        <i class="fas fa-eye text-xs"></i>
                    </a>
                    @endif
                    <button onclick="copyToClipboard('{{ asset('storage/' . $item->path) }}')"
                            class="bg-white text-gray-800 rounded-full p-1.5 hover:bg-gray-100 transition" title="Salin URL">
                        <i class="fas fa-link text-xs"></i>
                    </button>
                    <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Hapus file ini?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition" title="Hapus">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>

                {{-- Info --}}
                <div class="p-2">
                    <p class="text-xs text-gray-700 truncate font-medium" title="{{ $item->filename }}">{{ $item->filename }}</p>
                    <p class="text-xs text-gray-400">{{ $item->readable_size }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $media->links() }}</div>
    @endif
</div>

<div id="copy-toast" class="fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg text-sm opacity-0 transition-opacity pointer-events-none">
    URL disalin!
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copy-toast');
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 2000);
    });
}
</script>
@endpush
