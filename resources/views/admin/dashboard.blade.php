@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<h2 class="mb-3">All Tickets</h2>

@foreach($tickets as $t)
    <div class="ticket-card">
        <p><strong>{{ $t->category }}</strong></p>
        <p>{{ $t->description }}</p>
        <p><strong>Assigned to:</strong> {{ $t->assigned_to ?? 'Not assigned' }}</p>
    </div>
@endforeach

@endsection
