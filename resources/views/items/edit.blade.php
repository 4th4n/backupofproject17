<!-- resources/views/items/edit.blade.php -->

@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Edit Item</h2>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $item->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $item->quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="low_stock_level" class="form-label">Low Stock Level</label>
            <input type="number" name="low_stock_level" class="form-control" value="{{ old('low_stock_level', $item->low_stock_level) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
