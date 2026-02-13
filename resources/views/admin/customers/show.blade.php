@extends('admin.layout')

@section('title', 'Customer Profile | ' . $user->name)

@section('content')
<div class="container mx-auto max-w-6xl">
    {{-- Breadcrumb & Header --}}
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('admin.customers.index') }}" class="group w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm hover:shadow-md">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
        </a>
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                <span>Customers</span>
                <i class="fas fa-chevron-right text-[7px]"></i>
                <span class="text-blue-600">Profile</span>
            </nav>
            <h2 class="text-3xl font-black text-slate-900 italic uppercase tracking-tight">Customer <span class="text-blue-600">Profile</span></h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        {{-- Left: Customer Card --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 text-center relative overflow-hidden group">
                {{-- Decorative Circle --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10">
                    <div class="w-28 h-28 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-[35px] flex items-center justify-center mx-auto mb-6 text-white text-4xl font-black shadow-xl shadow-blue-100 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight italic">{{ $user->name }}</h3>
                    <p class="text-sm text-slate-400 font-bold mb-8 tracking-tighter">{{ $user->email }}</p>
                    
                    <div class="space-y-4 pt-8 border-t border-slate-50">
                        <div class="flex items-center justify-between text-left">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Role</span>
                            <span class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded-lg uppercase tracking-widest">{{ $user->role }}</span>
                        </div>
                        <div class="flex items-center justify-between text-left">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Member Since</span>
                            <span class="text-xs font-bold text-slate-600">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-left">
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Total Orders</span>
                            <span class="text-xs font-black text-blue-600 italic">{{ $orders->count() }} Orders</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Support Card --}}
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-[35px] shadow-xl text-white">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-4 italic text-center">Quick Support</p>
                <div class="flex flex-col gap-3 text-center">
                    <p class="text-xs font-medium text-slate-400">តើអ្នកត្រូវការជំនួយជាមួយអតិថិជននេះមែនទេ?</p>
                    <a href="mailto:{{ $user->email }}" class="mt-2 w-full bg-white/5 hover:bg-white/10 border border-white/10 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all">
                        <i class="far fa-envelope mr-2"></i> Send Email
                    </a>
                </div>
            </div>
        </div>

        {{-- Right: Purchase History --}}
        <div class="lg:col-span-8">
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 min-h-full">
                <div class="flex items-center justify-between mb-10 border-b border-slate-50 pb-6">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest italic">Purchase History</h3>
                    <div class="flex gap-2">
                        <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
                        <div class="w-2 h-2 rounded-full bg-slate-200"></div>
                    </div>
                </div>

                <div class="space-y-8">
                    @forelse($orders as $order)
                    <div class="relative pl-8 before:content-[''] before:absolute before:left-0 before:top-0 before:w-1 before:h-full before:bg-slate-50 before:rounded-full group">
                        <div class="absolute left-0 top-0 w-1 h-0 bg-blue-500 rounded-full group-hover:h-full transition-all duration-500"></div>
                        
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                            <div>
                                <h4 class="font-black italic text-slate-900 tracking-tighter uppercase text-lg">Order #{{ $order->id }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-blue-600 italic text-2xl tracking-tighter">${{ number_format($order->total_amount, 2) }}</p>
                                <span class="inline-block mt-2 text-[9px] uppercase font-black px-4 py-1.5 rounded-xl tracking-widest shadow-sm border
                                    @if($order->status == 'completed') bg-emerald-50 text-emerald-500 border-emerald-100
                                    @elseif($order->status == 'pending') bg-orange-50 text-orange-500 border-orange-100
                                    @else bg-blue-50 text-blue-500 border-blue-100 @endif">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-4 bg-slate-50/50 rounded-2xl border border-transparent hover:border-slate-100 hover:bg-white transition-all duration-300">
                                <div class="w-14 h-14 bg-white rounded-xl flex-shrink-0 overflow-hidden border border-slate-100 shadow-sm">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="flex items-center justify-center h-full text-slate-200 bg-slate-50">
                                            <i class="fas fa-laptop text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-black text-slate-700 uppercase italic tracking-tight truncate">{{ $item->product->name ?? 'Unknown Product' }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] font-black text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md uppercase tracking-tighter">Qty: {{ $item->quantity }}</span>
                                        <span class="text-[9px] font-bold text-slate-400">@ ${{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <div class="py-24 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                            <i class="fas fa-shopping-bag text-3xl"></i>
                        </div>
                        <h4 class="text-sm font-black text-slate-800 uppercase italic tracking-widest">No Activity Yet</h4>
                        <p class="text-xs text-slate-400 mt-2">អតិថិជននេះមិនទាន់មានប្រវត្តិទិញទំនិញនៅឡើយទេ។</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection