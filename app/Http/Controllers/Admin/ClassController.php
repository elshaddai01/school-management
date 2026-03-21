<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // List all classes
    public function index()
    {
        $classes = AcademicClass::withCount('students')->get();
        return view('admin.classes.index', compact('classes'));
    }

    // Show create form
    public function create()
    {
        return view('admin.classes.create');
    }

    // Save new class
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:60|unique:classes,name',
            'level'   => 'required|string|max:40',
            'section' => 'nullable|string|max:10',
        ]);

        AcademicClass::create($request->only('name', 'level', 'section'));

        return redirect()->route('admin.classes.index')
                         ->with('success', 'Class created successfully.');
    }

    // Show edit form
    public function edit(AcademicClass $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    // Save edited class
    public function update(Request $request, AcademicClass $class)
    {
        $request->validate([
            'name'    => 'required|string|max:60|unique:classes,name,' . $class->id,
            'level'   => 'required|string|max:40',
            'section' => 'nullable|string|max:10',
        ]);

        $class->update($request->only('name', 'level', 'section'));

        return redirect()->route('admin.classes.index')
                         ->with('success', 'Class updated successfully.');
    }

    // Delete class
    public function destroy(AcademicClass $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')
                         ->with('success', 'Class deleted successfully.');
    }
}