@extends('admin.layout')

@section('title', 'Order Details #' . $order->id)

@section('content')
<div class="container mx-auto max-w-5xl">
    {{-- Navigation & Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.orders.index') }}" class="hover:text-blue-600 transition">Orders</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-blue-600">Details</span>
            </nav>
            <h2 class="text-3xl font-black text-slate-900 italic uppercase tracking-tight">
                Order <span class="text-blue-600">#{{ $order->id }}</span>
            </h2>
        </div>
        
        {{-- Dynamic Status Badge --}}
        <div class="px-6 py-2 rounded-2xl font-black uppercase italic text-xs tracking-widest border
            @if($order->status == 'pending') bg-orange-50 text-orange-500 border-orange-100
            @elseif($order->status == 'processing') bg-blue-50 text-blue-500 border-blue-100
            @elseif($order->status == 'completed') bg-emerald-50 text-emerald-500 border-emerald-100
            @else bg-gray-50 text-gray-500 border-gray-100 @endif">
            Current Status: {{ $order->status }}
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- ផ្នែកខាងឆ្វេង៖ ព័ត៌មានអតិថិជន និងការផ្លាស់ប្តូរ Status --}}
        <div class="lg:col-span-1 space-y-8">
            {{-- Customer Information Card --}}
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 border-b pb-4 italic">Customer Details</h3>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-user text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Name</p>
                            <p class="font-bold text-slate-800">{{ $order->customer_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-phone text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Phone</p>
                            <p class="font-bold text-slate-800">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Address</p>
                            <p class="font-bold text-slate-800 text-sm leading-relaxed">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Update Card --}}
            <div class="bg-slate-900 p-8 rounded-[32px] shadow-2xl text-white">
                <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-6 italic">Control Status</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <select name="status" class="w-full px-5 py-4 bg-slate-800 border border-slate-700 rounded-2xl outline-none focus:border-blue-500 transition font-bold text-xs appearance-none cursor-pointer text-slate-300">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-900/40">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ផ្នែកខាងស្តាំ៖ បញ្ជីទំនិញ --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-8 md:p-10 rounded-[32px] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 border-b pb-5 italic">Purchased Items</h3>
                
                <div class="space-y-6">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-6 group">
                        {{-- Product Icon/Image Placeholder --}}
                        <div class="w-20 h-20 bg-slate-50 rounded-[22px] flex-shrink-0 flex items-center justify-center border border-slate-100 group-hover:border-blue-200 transition duration-300">
                            <i class="fas fa-laptop text-2xl text-slate-200 group-hover:text-blue-200 transition"></i>
                        </div>

                        {{-- Product Details --}}
                        <div class="flex-1 min-w-0">
                            <h4 class="font-black text-slate-800 uppercase italic tracking-tight mb-2 truncate">{{ $item->product_name }}</h4>
                            <div class="flex items-center gap-3">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-lg border border-slate-100">
                                    QTY: <span class="text-blue-600">{{ $item->quantity }}</span>
                                </span>
                                <span class="text-xs font-bold text-slate-500">@ ${{ number_format($item->price, 2) }}</span>
                            </div>
                        </div>

                        {{-- Item Subtotal --}}
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Subtotal</p>
                            <p class="font-black text-slate-900 italic tracking-tight">${{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Total Calculation Section --}}
                <div class="mt-12 pt-8 border-t-2 border-dashed border-slate-50 flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2 font-bold">Total Payment</p>
                        <p class="text-4xl font-black text-blue-600 italic tracking-tighter">${{ number_format($order->total_price, 2) }}</p>
                    </div>
                    <div class="text-right text-slate-300 text-[9px] font-bold uppercase tracking-widest hidden md:block">
                        <i class="fas fa-shield-alt mr-1 text-blue-500/20"></i> TECH ZONE Verified Order
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection