@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Dashboard</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-light p-3">
                <h5>Total Students</h5>
                <p>{{ $studentCount }}</p>
                <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light p-3">
                <h5>Total Teachers</h5>
                <p>{{ $teacherCount }}</p>
                <a href="{{ route('teachers.index') }}" class="btn btn-primary btn-sm">Manage Teachers</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light p-3">
                <h5>Total Payments</h5>
                <p>₹ {{ $paymentTotal }}</p>
                <a href="{{ route('payments.index') }}" class="btn btn-primary btn-sm">Manage Payments</a>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    <div class="card">
        <div class="card-header">
            <h5>Quick Access</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-plus"></i> Add New Student
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('students.index') }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-list"></i> View All Students
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('batches.index') }}" class="btn btn-secondary btn-block mb-2">
                        <i class="fas fa-users"></i> Manage Batches
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-book"></i> Manage Enrollments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection