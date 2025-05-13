@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">Edit Student</div>
    <div class="card-body">
        <form action="{{ url('/students/' . $student->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" value="{{ old('address', $student->address) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" value="{{ old('mobile', $student->mobile) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="batch_id">Batch</label>
                <select name="batch_id" class="form-control" required>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $student->batch_id == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>
@endsection
