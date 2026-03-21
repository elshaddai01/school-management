@extends('layouts.app')
@section('title', 'Edit Subject')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.subjects.index') }}"
       class="text-sm text-blue-700 hover:underline">
        &larr; Back to Subjects
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-lg">

    <h1 class="text-xl font-bold text-blue-900 mb-6">
        Edit Subject — {{ $subject->name }}
    </h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700
                    rounded px-4 py-3 mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.subjects.update', $subject) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Subject Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name"
                   value="{{ old('name', $subject->name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Code
                <span class="text-gray-400 text-xs">(optional)</span>
            </label>
            <input type="text" name="code"
                   value="{{ old('code', $subject->code) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Coefficient <span class="text-red-500">*</span>
            </label>
            <input type="number" name="coefficient"
                   value="{{ old('coefficient', $subject->coefficient) }}"
                   min="1" max="10"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Assign to Classes
            </label>
            <div class="border border-gray-200 rounded p-3 space-y-2 max-h-48 overflow-y-auto">
                @foreach($classes as $class)
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="classes[]"
                           value="{{ $class->id }}"
                           {{ in_array($class->id, old('classes', $assignedClasses)) ? 'checked' : '' }}
                           class="rounded">
                    {{ $class->name }}
                </label>
                @endforeach
            </div>
        </div>

        <button type="submit"
            class="bg-teal-700 text-white px-6 py-2 rounded
                   hover:bg-teal-600 text-sm font-medium">
            Update Subject
        </button>
    </form>
</div>

@endsection