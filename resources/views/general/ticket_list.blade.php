<h1>Your Tickets</h1>

{{-- Success message --}}
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@foreach($tickets as $t)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>Category:</strong> {{ $t->category }} <br>
        <strong>Description:</strong> {{ $t->description }} <br>

        {{-- Show attachment if exists --}}
        @if($t->attachment)
            <strong>Attachment:</strong>
            <a href="{{ asset('storage/attachments/' . $t->attachment) }}" target="_blank">View</a>
        @endif
    </div>
@endforeach
