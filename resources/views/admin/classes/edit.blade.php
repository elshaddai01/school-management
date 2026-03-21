@extends('layouts.app')
@section('title', 'Edit Class')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.classes.index') }}"
       class="text-sm text-blue-700 hover:underline">
        &larr; Back to Classes
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-lg">

    <h1 class="text-xl font-bold text-blue-900 mb-6">
        Edit Class — {{ $class->name }}
    </h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700
                    rounded px-4 py-3 mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.classes.update', $class) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Class Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name"
                   value="{{ old('name', $class->name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Level <span class="text-red-500">*</span>
            </label>
            <input type="text" name="level"
                   value="{{ old('level', $class->level) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Section <span class="text-gray-400 text-xs">(optional)</span>
            </label>
            <input type="text" name="section"
                   value="{{ old('section', $class->section) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
            class="bg-teal-700 text-white px-6 py-2 rounded
                   hover:bg-teal-600 text-sm font-medium">
            Update Class
        </button>
    </form>
</div>

@endsection