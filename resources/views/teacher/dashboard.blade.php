@extends('layouts.app')
@section('title', 'Teacher Dashboard')

@section('content')

<h1 class="text-2xl font-bold text-teal-800 mb-2">
    Welcome, {{ $user->name }}
</h1>
<p class="text-gray-500 mb-6">
    Active year:
    <span class="font-medium text-gray-700">
        {{ $activeYear->name ?? 'Not set' }}
    </span>
</p>

@if($assignments->isEmpty())
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 max-w-md">
        <p class="text-yellow-800 text-sm">
            You have no subjects assigned yet.
            Contact your administrator.
        </p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($assignments as $subject)
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-200">
            <p class="font-bold text-teal-800 text-lg">{{ $subject->name }}</p>
            <p class="text-xs text-gray-400 mt-1">
                Coefficient: {{ $subject->coefficient }}
            </p>
        </div>
        @endforeach
    </div>
@endif

@endsection