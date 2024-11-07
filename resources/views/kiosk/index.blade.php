@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Title -->
    <h1 class="text-center mb-5"></h1>

    <!-- Search Bar -->
    <div class="search-container">
        <form class="search-input-group" action="{{ route('menu.search') }}" method="GET">
            <input class="form-control" type="search" name="query" placeholder="Search" aria-label="Search">
            <button type="submit" class="icon-btn">
                <i class="bi bi-search"></i>
            </button>
            <button type="button" class="icon-btn search-mic-btn">
                <i class="bi bi-mic"></i>
            </button>
        </form>
    </div>

    <!-- Category Buttons -->
    <div class="category-container my-4">
        
        <div class="category-buttons">
            <a href="{{ route('menu.category', 'breakfast') }}" class="category-link">Breakfast</a>
            <a href="{{ route('menu.category', 'lunch') }}" class="category-link">Lunch</a>
            <a href="{{ route('menu.category', 'snacks') }}" class="category-link">Snacks</a>
            <a href="{{ route('menu.category', 'cup-noodles') }}" class="category-link">Cup Noodles</a>
            <a href="{{ route('menu.category', 'drinks') }}" class="category-link">Drinks</a>
            <a href="{{ route('menu.category', 'biscuits') }}" class="category-link">Biscuits</a>
            <a href="{{ route('menu.category', 'junk-foods') }}" class="category-link">Junk Foods</a>
            <a href="{{ route('menu.category', 'chocolates') }}" class="category-link">Chocolates</a>
        </div>
    </div>
    <div class="row">
        <!-- Menu Section -->
        <div class="col-md-8">
            <h2 class="mb-4">Menu</h2>
            <div class="row">
                @if(isset($items) && !$items->isEmpty())
                    @foreach($items as $item)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($item->image)
                            <img src="{{ asset('images/' . $item->image) }}" class="card-img-top img-fluid" alt="{{ $item->name }}">
                            @else
                            <img src="{{ asset('images/default.png') }}" class="card-img-top img-fluid" alt="Default Image">
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">Price: <strong>₱{{ number_format($item->price, 2) }}</strong></p>
                                <form action="{{ route('order.add') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-primary btn-block add-to-order-btn">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>No items found.</p>
                @endif
            </div>
        </div>

        <!-- Order Section -->
        <div class="col-md-4">
            <h2 class="mb-4">Your Order</h2>
            @if(session('order'))
            <ul class="list-group mb-3">
                @foreach(session('order') as $id => $details)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="order-item-info">
                        <h6 class="mb-0">{{ $details['name'] }}</h6>
                        <div class="d-flex align-items-center">
                            <!-- Minus button -->
                            <form action="{{ route('order.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                <button type="submit" class="btn btn-light btn-sm me-2" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </form>
                            
                            <!-- Quantity display -->
                            <span class="fw-bold">{{ $details['quantity'] }}</span>

                            <!-- Plus button -->
                            <form action="{{ route('order.update') }}" method="POST" class="ms-2">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                <button type="submit" class="btn btn-light btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="order-item-controls d-flex align-items-center">
                        <span class="order-item-price">₱{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                        
                        <!-- Remove Button -->
                        <form action="{{ route('order.remove') }}" method="POST" class="ms-3">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="total-amount mb-3">
                <h4>Total: <strong>₱{{ number_format($totalAmount, 2) }}</strong></h4>
            </div>
            <a href="{{ route('order.checkout') }}" class="btn btn-success btn-block">
                <i class="fas fa-shopping-cart"></i> Checkout
            </a>
            @else
            <div class="alert alert-info">
                <p>Your order is currently empty.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Style adjustments -->
<style>
    .container-fluid {
        max-width: 100%;
        padding: 0 15px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        height: auto;
    }

    .card-img-top {
        height: 180px;
        object-fit: cover;
    }

    .add-to-order-btn {
        padding: 12px;
        font-size: 1.1rem;
    }

    /* Order Section Styling */
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border: none;
    }

    .order-item-info {
        flex-grow: 1;
    }

    .order-item-controls {
        display: flex;
        align-items: center;
    }

    .order-item-price {
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-light {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }

    .btn-block {
        width: 100%;
    }

    /* Category Links Styling */
    .category-container {
        margin-bottom: 20px;
        text-align: center;
    }

    .category-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .category-link {
        font-size: 1.1rem;
        color: black; /* Set text color to black */
        text-decoration: none;
        padding: 5px 10px;
        transition: color 0.3s ease, border-bottom 0.3s ease;
    }

    .category-link:hover {
        color: #0056b3; /* Change color on hover */
        border-bottom: 2px solid #0056b3;
    }

    @media (max-width: 1200px) {
        .col-md-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .container-fluid {
            padding: 0 10px;
        }

        .card {
            margin-bottom: 20px;
        }

        .add-to-order-btn {
            font-size: 1rem;
            padding: 10px;
        }

        .category-link {
            font-size: 1rem;
            padding: 5px 8px;
        }
    }
</style>
@endsection
