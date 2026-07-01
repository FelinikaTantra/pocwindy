<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch homepage settings
        $settings = Setting::where('group', 'home')->pluck('value', 'key')->toArray();

        // Fetch categories (all or active if you have a status field)
        $categories = Category::all();

        // Fetch latest products (e.g., 4 or 8), including their first image
        $products = Product::with('images')->latest()->take(8)->get();

        return view('welcome', compact('settings', 'categories', 'products'));
    }
}
