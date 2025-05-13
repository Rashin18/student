@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">Add New Student</div>
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="batch_id">Batch</label>
                <select name="batch_id" id="batch_id" class="form-control @error('batch_id') is-invalid @enderror" required>
                    <option value="">Select Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }}
                            @if(auth()->user()->role === 'admin')
                                @if($batch->teacher)
                                    (Teacher: {{ $batch->teacher->name }})
                                @else
                                    (No teacher assigned)
                                @endif
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('batch_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" 
                       class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" 
                       class="form-control @error('mobile') is-invalid @enderror" 
                       value="{{ old('mobile') }}" required>
                @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
