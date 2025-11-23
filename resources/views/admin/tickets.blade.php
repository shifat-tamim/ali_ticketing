@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h3>Manage Tickets</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Assigned To</th>
                <th>Change To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->subject }}</td>
                <td>{{ $t->assignedTo ? $t->assignedTo->name : 'Not Assigned' }}</td>

                <td>
                    <form action="{{ route('admin.tickets.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $t->id }}">

                        <select name="user_id" class="form-select" required>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-sm btn-success mt-1">Assign</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
