@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">Batch Details</div>
    <div class="card-body">
        <h5 class="card-title">Batch Name: {{ $batches->name }}</h5>
        <p class="card-text">Course Name: {{ $batches->course->name }}</p>
        <p class="card-text">Start Date: {{ $batches->start_date }}</p>
        <p class="card-text">Teacher: {{ $batches->teacher->name }}</p> <!-- Teacher Display -->
    </div>
</div>
@stop
