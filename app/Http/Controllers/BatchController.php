<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\View\View;
use App\Models\Teacher;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $batches = Batch::all();
        return view("batches.index")->with("batches", $batches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $courses = Course::all();
    $teachers = Teacher::all(); // Assuming you have a Teacher model
    return view('batches.create', compact('courses', 'teachers'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'course_id' => 'required|integer|exists:courses,id',
        'start_date' => 'required|date_format:Y-m-d',
        'teacher_id' => 'required|integer|exists:teachers,id',
    ]);

    Batch::create($validated);

    return redirect('batches')->with("flash_message", "Batch Added!");
}


    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $batches = Batch::find($id);
        return view("batches.show")->with("batches", $batches);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $batches = Batch::findOrFail($id);
        $courses = Course::all(); // Make sure Course model is imported at the top
        $teachers = Teacher::all(); // Fetch all teachers
        return view('batches.edit', compact('batches', 'courses', 'teachers')); // Pass teachers to the view
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $batches = Batch::find($id);
        $input = $request->all();
        $batches->update($input);
        return redirect("batches")->with("flash_message","Batch Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Batch::destroy($id);
        return redirect("batches")->with("flash_message","Batch deleted!");
    }
}
