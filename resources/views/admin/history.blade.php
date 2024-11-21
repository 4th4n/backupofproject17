@extends('admin.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">List Orders</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No past orders found.
        </div>
    @else
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Order Details</h3>
            <!-- Print Button -->
            <button class="btn btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
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
                                    <td>{{ $order->created_at->timezone('Asia/Manila')->format('F j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
<style>
    @media print {
    button {
        display: none; /* Itago ang Print button sa print output */
    }
}

</style>
@endsection
