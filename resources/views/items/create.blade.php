@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Create Item</h2>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Item Name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*"> <!-- Image upload field -->
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Snacks">Snacks</option>
                <option value="Cup Noodles">Cup Noodles</option>
                <option value="Drinks">Drinks</option>
                <option value="Biscuits">Biscuits</option>
                <option value="Junk foods">Junk foods</option>
                <option value="Chocolates">Chocolates</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Item</button>
    </form>
</div>
@endsection
