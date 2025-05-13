<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::query()
            ->when(auth()->user()->role === 'teacher', function ($query) {
                $query->whereHas('batch', function ($q) {
                    $q->where('teacher_id', auth()->id());
                });
            })
            ->with('batch.teacher')
            ->latest()
            ->get();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        $this->authorize('create', Student::class);

        $batches = auth()->user()->role === 'teacher'
            ? Batch::where('teacher_id', auth()->id())->get()
            : Batch::all();

        return view('students.create', compact('batches'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        if (auth()->user()->role === 'teacher') {
            $batch = Batch::findOrFail($validated['batch_id']);
            if ($batch->teacher_id !== auth()->id()) {
                abort(403, 'You can only add students to your own batches.');
            }
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student): View
    {
        $this->authorize('view', $student);

        $student->load('batch.teacher');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        $this->authorize('update', $student);

        $student->load('batch');

        $batches = auth()->user()->role === 'teacher'
            ? Batch::where('teacher_id', auth()->id())->get()
            : Batch::all();

        return view('students.edit', compact('student', 'batches'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $this->authorize('update', $student);

        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        if (auth()->user()->role === 'teacher') {
            $batch = Batch::findOrFail($validated['batch_id']);
            if ($batch->teacher_id !== auth()->id()) {
                abort(403, 'You can only assign students to your own batches.');
            }
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $this->authorize('delete', $student);

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
