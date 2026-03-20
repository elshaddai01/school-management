<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\AcademicClass;
use App\Models\Subject;
use App\Models\AcademicYear;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalStudents'  => Student::count(),
            'totalTeachers'  => User::where('role', 'teacher')->count(),
            'totalClasses'   => AcademicClass::count(),
            'totalSubjects'  => Subject::count(),
            'activeYear'     => AcademicYear::where('is_active', true)->first(),
        ];

        return view('admin.dashboard', $data);
    }
}