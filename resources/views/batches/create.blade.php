@extends('layout')

@section('content')

<div class="card">
    <div class="card-header">Batches</div>
    <div class="card-body">

        <form action="{{ url('batches') }}" method="post">
            {!! csrf_field() !!}
            
            <!-- Batch Name -->
            <label>Batch Name</label></br>
            <input type="text" name="name" id="name" class="form-control" required></br>

            <!-- Course Name -->
            <label>Course Name</label></br>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select><br>

            <!-- Start Date -->
            <label>Start Date</label></br>
            <input type="date" name="start_date" class="form-control" required></br>

            <!-- Teacher Name (new field) -->
            <label>Teacher Name</label></br>
            <select name="teacher_id" class="form-control" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select><br>

            <!-- Submit Button -->
            <input type="submit" value="Save" class="btn btn-success"></br>
        </form>

    </div>
</div>

@stop
