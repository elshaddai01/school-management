@extends('layouts.app')
@section('title', 'Add Subject')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.subjects.index') }}"
       class="text-sm text-blue-700 hover:underline">
        &larr; Back to Subjects
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-lg">

    <h1 class="text-xl font-bold text-blue-900 mb-6">Add New Subject</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700
                    rounded px-4 py-3 mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.subjects.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Subject Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}"
                   placeholder="e.g. Mathematics"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Code
                <span class="text-gray-400 text-xs">(optional)</span>
            </label>
            <input type="text" name="code" value="{{ old('code') }}"
                   placeholder="e.g. MATH"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Coefficient <span class="text-red-500">*</span>
            </label>
            <input type="number" name="coefficient"
                   value="{{ old('coefficient', 1) }}"
                   min="1" max="10"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Assign to Classes
                <span class="text-gray-400 text-xs">(optional — tick all that apply)</span>
            </label>
            <div class="border border-gray-200 rounded p-3 space-y-2 max-h-48 overflow-y-auto">
                @foreach($classes as $class)
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="classes[]"
                           value="{{ $class->id }}"
                           {{ in_array($class->id, old('classes', [])) ? 'checked' : '' }}
                           class="rounded">
                    {{ $class->name }}
                </label>
                @endforeach
            </div>
        </div>

        <button type="submit"
            class="bg-blue-800 text-white px-6 py-2 rounded
                   hover:bg-blue-700 text-sm font-medium">
            Save Subject
        </button>
    </form>
</div>

@endsection