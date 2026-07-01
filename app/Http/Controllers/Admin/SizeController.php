<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:50|unique:sizes',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        Size::create([
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.sizes.index')->with('success', 'Ukuran berhasil ditambahkan.');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name'       => 'required|string|max:50|unique:sizes,name,' . $size->id,
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $size->update([
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.sizes.index')->with('success', 'Ukuran berhasil diperbarui.');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index')->with('success', 'Ukuran berhasil dihapus.');
    }
}
