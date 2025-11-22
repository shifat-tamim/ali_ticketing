@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded px-3 py-2 mb-4">
    <div class="container-fluid">

        <!-- Logo Left -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/images/logo.png" alt="Logo" style="height: 45px;">
        </a>

        <!-- Hamburger for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Right -->
        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.list') }}"
>
                        <i class="bi bi-list-check"></i> Tickets
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.create') }}">
                        <i class="bi bi-plus-circle"></i> Create Ticket
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>


<!-- BODY CONTENT -->
<div class="container">

    <h3 class="text-center mb-4">Your Tickets</h3>

    @if(isset($tickets) && count($tickets) > 0)

        @foreach($tickets as $ticket)
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $ticket->category }}</strong></h5>
                    <p class="card-text">{{ $ticket->description }}</p>
                    <span class="badge bg-primary">{{ $ticket->status }}</span>
                </div>
            </div>
        @endforeach

    @else
        <div class="text-center py-5">
            <h5>No tickets created yet.</h5>
            <a href="{{ route('ticket.create') }}" class="btn btn-primary mt-3">
                Create Your First Ticket
            </a>
        </div>
    @endif

</div>

@endsection
