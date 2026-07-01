<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::latest();

        if ($request->filled('search')) {
            $query->where('filename', 'like', '%' . $request->search . '%')
                  ->orWhere('alt', 'like', '%' . $request->search . '%');
        }

        $media = $query->paginate(24)->withQueryString();

        // JSON mode for the picker modal
        if ($request->expectsJson()) {
            return response()->json([
                'data' => $media->map(fn($m) => [
                    'id'       => $m->id,
                    'url'      => asset('storage/' . $m->path),
                    'filename' => $m->filename,
                    'size'     => $m->readable_size,
                    'is_image' => $m->isImage(),
                ]),
                'next_page_url' => $media->nextPageUrl(),
            ]);
        }

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files'   => 'required|array|max:10',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,webp,svg,pdf|max:5120',
        ]);

        $uploaded = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('media', 'public');

            $media = Media::create([
                'filename'  => $file->getClientOriginalName(),
                'path'      => $path,
                'mime_type' => $file->getMimeType(),
                'size'      => $file->getSize(),
            ]);

            $uploaded[] = $media;
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'files' => $uploaded]);
        }

        return redirect()->route('admin.media.index')->with('success', count($uploaded) . ' file berhasil diupload.');
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'alt' => 'nullable|string|max:255',
        ]);

        $medium->update(['alt' => $request->alt]);

        return redirect()->route('admin.media.index')->with('success', 'Alt text diperbarui.');
    }

    public function destroy(Media $medium)
    {
        Storage::disk('public')->delete($medium->path);
        $medium->delete();

        return redirect()->route('admin.media.index')->with('success', 'File berhasil dihapus.');
    }
}
