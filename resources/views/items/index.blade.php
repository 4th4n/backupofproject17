@extends('admin.dashboard')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Item List</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
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
    </div>
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
