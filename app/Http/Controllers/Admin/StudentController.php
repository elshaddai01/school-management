<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = Student::with('academicClass')->orderBy('last_name')->get();
        return view('admin.students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $classes = AcademicClass::orderBy('name')->get();
        return view('admin.students.create', compact('classes'));
    }

    // Save new student
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:80',
            'last_name'     => 'required|string|max:80',
            'class_id'      => 'required|exists:classes,id',
            'gender'        => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
        ]);

        Student::create($request->only(
            'first_name', 'last_name', 'class_id',
            'gender', 'date_of_birth'
        ));

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student enrolled successfully.');
    }

    // Show edit form
    public function edit(Student $student)
    {
        $classes = AcademicClass::orderBy('name')->get();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    // Save edited student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name'    => 'required|string|max:80',
            'last_name'     => 'required|string|max:80',
            'class_id'      => 'required|exists:classes,id',
            'gender'        => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
        ]);

        $student->update($request->only(
            'first_name', 'last_name', 'class_id',
            'gender', 'date_of_birth'
        ));

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student updated successfully.');
    }

    // Soft delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
                         ->with('success', 'Student removed successfully.');
    }
}