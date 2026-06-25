<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\ThemeSetting;

class PageController extends Controller
{
    public function show($slug = 'home')
    {
        $page = Page::with(['blocks' => function ($query) {
            $query->orderBy('order_index');
        }])->where('slug', $slug)
          ->where('status', 'published')
          ->firstOrFail();

        $themeSettings = ThemeSetting::all()->pluck('value', 'key')->toArray();

        return view('page', compact('page', 'themeSettings'));
    }
}
