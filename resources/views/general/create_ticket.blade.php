<h1>Create Ticket</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Category</label>
    <select name="category" required>
        <option value="">Select</option>
        <option value="Tech">Tech</option>
        <option value="Finance">Finance</option>
        <option value="Health">Health</option>
    </select>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Attachment</label>
    <input type="file" name="attachment">

    <button type="submit">Create Ticket</button>
</form>
