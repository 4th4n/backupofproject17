@extends('admin.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Order History</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No orders found.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Items</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>₱{{ number_format($order->total_price, 2) }} pesos</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($order->items as $item)
                                                <li>{{ $item->name }} ({{ $item->pivot->quantity }} pcs)</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $order->created_at->format('F j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    /* custom.css */

    body {
        background-color: #f8f9fa; /* Light background for better contrast */
    }

    h1 {
        color: #333; /* Darker text color for the heading */
        font-weight: bold; /* Bold font for emphasis */
    }

    .card {
        border: 1px solid #e0e0e0; /* Light border around the card */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .table {
        background-color: #ffffff; /* White background for the table */
    }

    .table thead th {
        background-color: #007bff; /* Bootstrap primary color for the header */
        color: white; /* White text for contrast */
    }

    .table tbody tr:hover {
        background-color: #f1f1f1; /* Light gray background on hover */
    }

    .alert {
        margin-bottom: 20px; /* Space below alert messages */
    }

    .list-unstyled {
        padding-left: 0; /* Remove default padding */
    }

    .list-unstyled li {
        margin-bottom: 5px; /* Space between items */
    }
</style>
@endsection
