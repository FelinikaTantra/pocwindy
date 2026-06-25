<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ThemeSetting;

class ThemeController extends Controller
{
    public function index()
    {
        $settings = ThemeSetting::all()->pluck('value', 'key')->toArray();
        return view('admin.theme.index', compact('settings'));
    }

    public function save(Request $request)
    {
        $settings = $request->except('_token');
        
        foreach ($settings as $key => $value) {
            ThemeSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.theme.index')->with('success', 'Theme settings updated.');
    }
}
