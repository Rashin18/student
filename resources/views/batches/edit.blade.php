@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">Edit Batch</div>
    <div class="card-body">
        <form action="{{ url('/batches/' . $batches->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $batches->id }}" />

            <!-- Batch Name -->
            <label>Batch Name</label></br>
            <input type="text" name="name" id="name" value="{{ $batches->name }}" class="form-control"></br>

            <!-- Course Name -->
            <label>Course Name</label></br>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $batches->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select><br>

            <!-- Start Date -->
            <label>Start Date</label></br>
            <input type="date" name="start_date" value="{{ $batches->start_date }}" class="form-control"></br> 

            <!-- Teacher Name (new field) -->
            <label>Teacher Name</label></br>
            <select name="teacher_id" class="form-control" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $batches->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select><br>

            <input type="submit" value="Update" class="btn btn-success"></br>
        </form>
    </div>
</div>
@stop


