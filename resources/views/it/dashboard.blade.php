<h1>IT Dashboard</h1>

<a href="{{ route('logout') }}">Logout</a>

<h2>Assigned Tickets</h2>

@foreach($tickets as $t)
    <p>
        <strong>{{ $t->category }}</strong><br>
        {{ $t->description }}<br>
        Status: {{ $t->status }}
    </p>
@endforeach
