<h1>Admin Dashboard</h1>
<a href="{{ route('logout') }}">Logout</a>

<h2>All Tickets</h2>
@foreach($tickets as $t)
    <p>
        <strong>{{ $t->category }}</strong><br>
        {{ $t->description }}<br>
        Assigned to: {{ $t->assigned_to ?? 'Not assigned' }}
    </p>
@endforeach


