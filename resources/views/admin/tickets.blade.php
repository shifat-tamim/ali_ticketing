@extends('admin.layout')

@section('content')

<h3 class="mb-4">Manage Tickets</h3>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Tickets Table -->
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <tr>
            <th>Ticket ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Change To</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td class="ticket-description">{{ $t->description }}</td>

            <!-- STATUS BADGE -->
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

            <td>
                {{ $t->assignedTo ? $t->assignedTo->name : 'Not Assigned' }}
            </td>

            <td>
                <form action="{{ route('admin.tickets.assign') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $t->id }}">

                    <select name="user_id" class="form-control" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-success btn-sm mt-2">Assign</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
