@extends('admin.layout')

@section('content')

<h3 class="mb-4">Ticket Reports</h3>

{{-- Error Messages --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Filter Form --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.reports.search') }}" method="POST" class="form-row">
            @csrf

            <div class="form-group col-md-4">
                <label for="from">From Date</label>
                <input type="date" id="from" name="from" class="form-control"
                       value="{{ isset($from) ? $from : '' }}" required>
            </div>

            <div class="form-group col-md-4">
                <label for="to">To Date</label>
                <input type="date" id="to" name="to" class="form-control"
                       value="{{ isset($to) ? $to : '' }}" required>
            </div>

            <div class="form-group col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Results Table --}}
@if(isset($tickets) && $tickets->count() > 0)

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Ticket ID</th>
                <th>Date</th>
                <th>Created By</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $t->user ? $t->user->name : 'Unknown' }}</td>
                <td class="ticket-description">{{ $t->description }}</td>
                <td>{{ $t->assignedTo ? $t->assignedTo->name : 'Not Assigned' }}</td>
                <td>
                    @if($t->status == 'Pending')
                        <span class="status-badge status-pending">Pending</span>
                    @elseif($t->status == 'In Progress')
                        <span class="status-badge status-progress">In Progress</span>
                    @elseif($t->status == 'Closed')
                        <span class="status-badge status-closed">Closed</span>
                    @else
                        <span class="status-badge status-other">{{ $t->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@elseif(isset($tickets))
    <div class="alert alert-info">
        No tickets found for the selected date range.
    </div>
@endif

@endsection
