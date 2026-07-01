<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function home()
    {
        $settings = Setting::where('group', 'home')->pluck('value', 'key')->toArray();
        return view('admin.settings.home', compact('settings'));
    }

    public function updateHome(Request $request)
    {
        $settings = $request->except('_token');
        
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'home'],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.home')->with('success', 'Homepage settings updated successfully.');
    }

    public function seo()
    {
        $settings = Setting::where('group', 'seo')->pluck('value', 'key')->toArray();
        return view('admin.settings.seo', compact('settings'));
    }

    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title'       => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords'    => 'nullable|string|max:255',
            'og_title'         => 'nullable|string|max:70',
            'og_description'   => 'nullable|string|max:200',
            'og_image'         => 'nullable|string|max:500',
            'google_analytics' => 'nullable|string|max:50',
            'google_tag'       => 'nullable|string|max:50',
        ]);

        $fields = [
            'meta_title', 'meta_description', 'meta_keywords',
            'og_title', 'og_description', 'og_image',
            'google_analytics', 'google_tag',
        ];

        foreach ($fields as $key) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'seo'],
                ['value' => $request->input($key)]
            );
        }

        return redirect()->route('admin.settings.seo')->with('success', 'SEO settings berhasil disimpan.');
    }

    public function general()
    {
        $settings = Setting::where('group', 'general')->pluck('value', 'key')->toArray();
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name'    => 'nullable|string|max:100',
            'brand_name'   => 'nullable|string|max:100',
            'site_email'   => 'nullable|email|max:100',
            'site_phone'   => 'nullable|string|max:30',
            'site_address' => 'nullable|string|max:300',
            'whatsapp'     => 'nullable|string|max:30',
            'instagram'    => 'nullable|string|max:100',
            'facebook'     => 'nullable|string|max:100',
            'tiktok'       => 'nullable|string|max:100',
            'logo_file'    => 'nullable|image|max:2048',
            'favicon_file' => 'nullable|file|mimes:png,ico,jpg,jpeg|max:512',
        ]);

        // Plain text fields
        $fields = [
            'site_name', 'brand_name', 'site_email', 'site_phone',
            'site_address', 'whatsapp', 'instagram', 'facebook', 'tiktok',
        ];

        foreach ($fields as $key) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'general'],
                ['value' => $request->input($key)]
            );
        }

        // Logo upload
        if ($request->hasFile('logo_file')) {
            $old = Setting::where('key', 'logo')->where('group', 'general')->value('value');
            if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
            $path = $request->file('logo_file')->store('identity', 'public');
            Setting::updateOrCreate(['key' => 'logo', 'group' => 'general'], ['value' => $path]);
        } elseif ($request->boolean('remove_logo')) {
            $old = Setting::where('key', 'logo')->where('group', 'general')->value('value');
            if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
            Setting::updateOrCreate(['key' => 'logo', 'group' => 'general'], ['value' => null]);
        }

        // Favicon upload
        if ($request->hasFile('favicon_file')) {
            $old = Setting::where('key', 'favicon')->where('group', 'general')->value('value');
            if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
            $path = $request->file('favicon_file')->store('identity', 'public');
            Setting::updateOrCreate(['key' => 'favicon', 'group' => 'general'], ['value' => $path]);
        }

        return redirect()->route('admin.settings.general')->with('success', 'General settings berhasil disimpan.');
    }
}
