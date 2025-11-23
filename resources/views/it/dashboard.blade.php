@extends('layouts.app')

@section('title', 'IT Dashboard')

@section('content')

<!-- NAVBAR (Only Tickets + Logout) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded px-3 py-2 mb-4">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="{{ route('it.dashboard') }}">
            <img src="/images/logo.png" alt="Logo" style="height: 45px;">
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('it.dashboard') }}">
                    <i class="bi bi-list-check"></i> Tickets
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE CONTENT -->
<div class="container" style="max-width: 900px;">
    <h3 class="text-center mb-4">All Tickets</h3>

    <!-- Success or Error -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @forelse($tickets as $t)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                
                <h5 class="card-title"><strong>{{ $t->category }}</strong></h5>
                <p class="card-text">{{ $t->description }}</p>

                <!-- STATUS BADGE -->
                <p>
                    @if($t->status == 'Pending')
                        <span class="status-badge status-pending">Pending</span>
                    @elseif($t->status == 'In Progress')
                        <span class="status-badge status-progress">In Progress</span>
                    @elseif($t->status == 'Closed')
                        <span class="status-badge status-closed">Closed</span>
                    @else
                        <span class="status-badge status-other">{{ $t->status }}</span>
                    @endif
                </p>

                <!-- Attachment -->
                @if($t->attachment)
                    <a href="{{ asset('storage/' . $t->attachment) }}" 
                       class="btn btn-outline-primary btn-sm" target="_blank">
                        <i class="bi bi-paperclip"></i> View Attachment
                    </a>
                @endif

                <!-- Ticket Actions & Assignment -->
                @if(is_null($t->assigned_to))
                    <a href="{{ route('ticket.takeover', $t->id) }}" 
                       class="btn btn-success btn-sm float-end">
                        <i class="bi bi-hand-index"></i> Takeover
                    </a>
                @else
                    <span class="badge bg-info">
                        Assigned to: {{ $t->assignedTo ? $t->assignedTo->name : 'Unknown' }}
                    </span>

                    @if($t->status != "Closed")
                        <a href="{{ route('ticket.close', $t->id) }}" 
                           class="btn btn-danger btn-sm float-end ms-2">
                            <i class="bi bi-x-circle"></i> Close Ticket
                        </a>
                    @endif
                @endif

            </div>
        </div>
    @empty

        <!-- No Tickets -->
        <div class="text-center py-5">
            <h5>No tickets available yet.</h5>
        </div>

    @endforelse
</div>

@endsection
