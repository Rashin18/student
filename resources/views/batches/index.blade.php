@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="text-center">Batches</h2>
    </div>
    <div class="card-body">
        <a href="{{ url('/batches/create') }}" class="btn btn-success btn-sm mb-3" title="Add New Batch">
            <i class="fa fa-plus"></i> Add New
        </a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Batch Name</th>
                        <th>Course Name </th>
                        <th>Start Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($batches as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->course ? $item->course->name : 'No Course Assigned' }}</td>
            <td>{{ $item->start_date }}</td>
            <td>
                <a href="{{ url('/batches/' . $item->id) }}" class="btn btn-info btn-sm" title="View">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ url('/batches/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                <form method="POST" action="{{ url('/batches/' . $item->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Confirm delete?')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
</div>

@endsection

