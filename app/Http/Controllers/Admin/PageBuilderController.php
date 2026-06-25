<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Support\Str;

class PageBuilderController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => 'published',
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function builder(Page $page)
    {
        $page->load(['blocks' => function ($q) {
            $q->orderBy('order_index');
        }]);
        
        return view('admin.pages.builder', compact('page'));
    }

    public function saveBlocks(Request $request, Page $page)
    {
        $blocks = $request->input('blocks', []);
        
        $page->blocks()->delete();

        foreach ($blocks as $index => $blockData) {
            PageBlock::create([
                'page_id' => $page->id,
                'type' => $blockData['type'],
                'order_index' => $index,
                'settings' => $blockData['settings'] ?? [],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
