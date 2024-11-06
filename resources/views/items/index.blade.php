@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Item List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td> <!-- Display price in pesos -->
                    <td>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(event, this.form)">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event, form) {
        event.preventDefault(); // Prevent form submission
        if (confirm('Are you sure you want to delete this item?')) {
            form.submit(); // Submit the form if user confirms
        }
    }
</script>
@endsection
