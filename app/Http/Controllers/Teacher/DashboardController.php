<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;

class DashboardController extends Controller
{
    public function index()
    {
        $user       = auth()->user();
        $activeYear = AcademicYear::where('is_active', true)->first();

        // Load the classes and subjects this teacher is assigned to
        $assignments = $user->subjects()->with('classes')->get();

        return view('teacher.dashboard', compact('user', 'activeYear', 'assignments'));
    }
}