@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">Student Details</div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $student->name }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>
        <p><strong>Mobile:</strong> {{ $student->mobile }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Batch:</strong> {{ $student->batch->name ?? 'N/A' }}</p>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
