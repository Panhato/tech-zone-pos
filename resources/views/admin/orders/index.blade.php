@extends('admin.layout')

@section('title', 'Orders | Admin')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="bg-white rounded-3xl shadow p-6">
        <h3 class="text-xl font-bold mb-4">Order Management</h3>
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-t">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
</div>
@endsection