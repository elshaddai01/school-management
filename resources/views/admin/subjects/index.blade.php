@extends('layouts.app')
@section('title', 'Subjects')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-900">Subjects</h1>
    <a href="{{ route('admin.subjects.create') }}"
       class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
        + Add Subject
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
                <th class="px-4 py-3 text-left">Subject Name</th>
                <th class="px-4 py-3 text-left">Code</th>
                <th class="px-4 py-3 text-left">Coefficient</th>
                <th class="px-4 py-3 text-left">Classes</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
            <tr class="border-t border-gray-100 hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium text-blue-900">
                    {{ $subject->name }}
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $subject->code ?? '—' }}
                </td>
                <td class="px-4 py-3">
                    <span class="bg-purple-100 text-purple-800
                                 px-2 py-0.5 rounded text-xs font-medium">
                        x{{ $subject->coefficient }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="bg-blue-100 text-blue-800
                                 px-2 py-0.5 rounded text-xs font-medium">
                        {{ $subject->classes_count }}
                        {{ Str::plural('class', $subject->classes_count) }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-3">
                    <a href="{{ route('admin.subjects.edit', $subject) }}"
                       class="text-teal-700 hover:underline text-xs">Edit</a>

                    <form method="POST"
                          action="{{ route('admin.subjects.destroy', $subject) }}"
                          onsubmit="return confirm('Delete this subject?')">
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
                    No subjects yet. Add your first subject.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection