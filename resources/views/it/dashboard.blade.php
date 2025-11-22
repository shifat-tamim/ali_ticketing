@extends('layouts.app')

@section('title', 'IT Dashboard')

@section('content')

<h2 class="mb-3">Assigned Tickets</h2>

@foreach($tickets as $t)
    <div class="ticket-card">
        <p><strong>{{ $t->category }}</strong></p>
        <p>{{ $t->description }}</p>
        <p><strong>Status:</strong> {{ $t->status }}</p>
    </div>
@endforeach

@endsection
