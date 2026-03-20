@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')

<h1 class="text-2xl font-bold text-blue-900 mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-200">
        <p class="text-sm text-gray-500">Total Students</p>
        <p class="text-3xl font-bold text-blue-900 mt-1">{{ $totalStudents }}</p>
    </div>

    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-200">
        <p class="text-sm text-gray-500">Total Teachers</p>
        <p class="text-3xl font-bold text-teal-700 mt-1">{{ $totalTeachers }}</p>
    </div>

    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-200">
        <p class="text-sm text-gray-500">Classes</p>
        <p class="text-3xl font-bold text-purple-700 mt-1">{{ $totalClasses }}</p>
    </div>

    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-200">
        <p class="text-sm text-gray-500">Subjects</p>
        <p class="text-3xl font-bold text-amber-700 mt-1">{{ $totalSubjects }}</p>
    </div>

</div>

@if($activeYear)
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-sm">
    <p class="text-sm text-blue-600 font-medium">Active Academic Year</p>
    <p class="text-xl font-bold text-blue-900 mt-1">{{ $activeYear->name }}</p>
    <p class="text-xs text-blue-500 mt-1">
        {{ $activeYear->start_date->format('d M Y') }}
        —
        {{ $activeYear->end_date->format('d M Y') }}
    </p>
</div>
@endif

@endsection