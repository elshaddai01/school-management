<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\AcademicClass;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('classes')->orderBy('name')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classes = AcademicClass::orderBy('name')->get();
        return view('admin.subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'code'        => 'nullable|string|max:20|unique:subjects,code',
            'coefficient' => 'required|integer|min:1|max:10',
            'classes'     => 'nullable|array',
            'classes.*'   => 'exists:classes,id',
        ]);

        $subject = Subject::create($request->only('name', 'code', 'coefficient'));

        // Attach to selected classes
        if ($request->filled('classes')) {
            $subject->classes()->sync($request->classes);
        }

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $classes        = AcademicClass::orderBy('name')->get();
        $assignedClasses = $subject->classes->pluck('id')->toArray();
        return view('admin.subjects.edit', compact('subject', 'classes', 'assignedClasses'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'code'        => 'nullable|string|max:20|unique:subjects,code,' . $subject->id,
            'coefficient' => 'required|integer|min:1|max:10',
            'classes'     => 'nullable|array',
            'classes.*'   => 'exists:classes,id',
        ]);

        $subject->update($request->only('name', 'code', 'coefficient'));
        $subject->classes()->sync($request->classes ?? []);

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->classes()->detach();
        $subject->delete();
        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Subject deleted successfully.');
    }
}