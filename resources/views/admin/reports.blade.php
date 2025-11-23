@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h3>Ticket Reports</h3>

    <form action="{{ route('admin.reports.search') }}" method="POST" class="row g-3 mt-3">
        @csrf
        <div class="col-md-4">
            <label>From Date</label>
            <input type="date" name="from" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label>To Date</label>
            <input type="date" name="to" class="form-control" required>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <div class="mt-4">
        @isset($tickets)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->createdBy->name }}</td>
                    <td>{{ $t->assignedTo ? $t->assignedTo->name : 'Not Assigned' }}</td>
                    <td>{{ $t->status }}</td>
                    <td>{{ $t->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endisset
    </div>
</div>
@endsection
