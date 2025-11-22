@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')

<!-- NAVBAR (same as user dashboard) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded px-3 py-2 mb-4">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="{{ route('user.dashboard') }}">
            <img src="/images/logo.png" alt="Logo" style="height: 45px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.list') }}">
                        <i class="bi bi-list-check"></i> Tickets
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('ticket.create') }}">
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

<!-- MAIN FORM BOX -->
<div class="container" style="max-width: 750px;">
    
    <div class="card shadow-sm p-4">
        <h3 class="mb-4 text-center">Create a New Ticket</h3>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Tech">Tech</option>
                    <option value="Finance">Finance</option>
                    <option value="Health">Health</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Attachment (optional)</label>
                <input type="file" name="attachment" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-send-fill"></i> Submit Ticket
            </button>
        </form>
    </div>

</div>

@endsection
