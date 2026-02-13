@extends('admin.layout')

@section('title', 'របាយការណ៍ស្តុក | Admin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 italic">Stock Inventory Report</h2>
        <button onclick="window.print()" class="bg-slate-800 text-white px-4 py-2 rounded-xl font-bold text-sm">
            <i class="fas fa-print mr-2"></i> Print Report
        </button>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] uppercase tracking-widest text-gray-400 font-bold">
                    <th class="px-6 py-4">Product Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4 text-center">In Stock</th>
                    <th class="px-6 py-4 text-center">Price ($)</th>
                    <th class="px-6 py-4 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-center font-bold">{{ $product->qty }}</td>
                    <td class="px-6 py-4 text-center text-blue-600 font-bold">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 text-right">
                        @if($product->qty <= 5)
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-bold">LOW STOCK</span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold">AVAILABLE</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection