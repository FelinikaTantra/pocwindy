@extends('layouts.admin')

@section('title', 'Theme Settings')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Theme Customizer</h2>

    <form action="{{ route('admin.theme.save') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="primary_color">Primary Color</label>
                <div class="flex items-center">
                    <input type="color" name="primary_color" id="primary_color" value="{{ $settings['primary_color'] ?? '#3b82f6' }}" class="h-10 w-10 border-0 rounded cursor-pointer p-0">
                    <span class="ml-3 text-gray-600 text-sm font-mono">{{ $settings['primary_color'] ?? '#3b82f6' }}</span>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="secondary_color">Secondary Color</label>
                <div class="flex items-center">
                    <input type="color" name="secondary_color" id="secondary_color" value="{{ $settings['secondary_color'] ?? '#1f2937' }}" class="h-10 w-10 border-0 rounded cursor-pointer p-0">
                    <span class="ml-3 text-gray-600 text-sm font-mono">{{ $settings['secondary_color'] ?? '#1f2937' }}</span>
                </div>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="font_family">Font Family</label>
                <select name="font_family" id="font_family" class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="'Inter', sans-serif" {{ ($settings['font_family'] ?? '') == "'Inter', sans-serif" ? 'selected' : '' }}>Inter</option>
                    <option value="'Roboto', sans-serif" {{ ($settings['font_family'] ?? '') == "'Roboto', sans-serif" ? 'selected' : '' }}>Roboto</option>
                    <option value="'Outfit', sans-serif" {{ ($settings['font_family'] ?? '') == "'Outfit', sans-serif" ? 'selected' : '' }}>Outfit</option>
                    <option value="'Playfair Display', serif" {{ ($settings['font_family'] ?? '') == "'Playfair Display', serif" ? 'selected' : '' }}>Playfair Display</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="border_radius">Border Radius (Global)</label>
                <input type="text" name="border_radius" id="border_radius" value="{{ $settings['border_radius'] ?? '0.5rem' }}" placeholder="e.g. 0.5rem, 8px" class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="flex items-center justify-end border-t pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                Save Theme Settings
            </button>
        </div>
    </form>
</div>
@endsection
