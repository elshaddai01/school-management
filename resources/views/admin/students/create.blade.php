@extends('layouts.app')
@section('title', 'Enrol Student')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.students.index') }}"
       class="text-sm text-blue-700 hover:underline">
        &larr; Back to Students
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-lg">

    <h1 class="text-xl font-bold text-blue-900 mb-6">Enrol New Student</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700
                    rounded px-4 py-3 mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.students.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                First Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="first_name" value="{{ old('first_name') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Last Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="last_name" value="{{ old('last_name') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Class <span class="text-red-500">*</span>
            </label>
            <select name="class_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">— Select class —</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Gender
            </label>
            <select name="gender"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">— Select —</option>
                <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Date of Birth
            </label>
            <input type="date" name="date_of_birth"
                   value="{{ old('date_of_birth') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
            class="bg-blue-800 text-white px-6 py-2 rounded
                   hover:bg-blue-700 text-sm font-medium">
            Enrol Student
        </button>
    </form>
</div>

@endsection