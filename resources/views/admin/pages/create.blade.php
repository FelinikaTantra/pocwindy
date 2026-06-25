@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-arrow-left mr-1"></i> Back to Pages
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Page</h2>

    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Page Title</label>
            <input type="text" name="title" id="title" class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            @error('title') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>
        
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Page
            </button>
        </div>
    </form>
</div>
@endsection
