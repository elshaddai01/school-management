@extends('layouts.app')
@section('title', 'Classes')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-900">Classes</h1>
    <a href="{{ route('admin.classes.create') }}"
       class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
        + Add Class
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800
                rounded px-4 py-3 mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-blue-900 text-white">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Class Name</th>
                <th class="px-4 py-3 text-left">Level</th>
                <th class="px-4 py-3 text-left">Section</th>
                <th class="px-4 py-3 text-left">Students</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $class)
            <tr class="border-t border-gray-100 hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium text-blue-900">{{ $class->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $class->level }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $class->section ?? '—' }}</td>
                <td class="px-4 py-3">
                    <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs font-medium">
                        {{ $class->students_count }} students
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-3">
                    <a href="{{ route('admin.classes.edit', $class) }}"
                       class="text-teal-700 hover:underline text-xs">Edit</a>

                    <form method="POST"
                          action="{{ route('admin.classes.destroy', $class) }}"
                          onsubmit="return confirm('Delete this class?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 hover:underline text-xs">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                    No classes yet. Add your first class.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection