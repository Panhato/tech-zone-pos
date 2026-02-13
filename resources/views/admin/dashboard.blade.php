@extends('admin.layout')

@section('title', 'Dashboard | Tech Zone')

@section('content')
<div class="container mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight italic">Business Overview</h2>
            <p class="text-gray-500 font-medium">តាមដានសកម្មភាពលក់ និងស្ថានភាពស្តុកទំនិញសរុប</p>
        </div>
        <div class="text-sm font-bold text-slate-400 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d M Y') }}
        </div>
    </div>

    {{-- Low Stock Alert Section (បន្ថែមថ្មី) --}}
    @if($lowStockProducts->count() > 0 || $outOfStockProducts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        {{-- Out of Stock (ដាច់ស្តុក) --}}
        @if($outOfStockProducts->count() > 0)
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-2xl shadow-sm">
            <div class="flex items-center gap-3 mb-3 text-red-700">
                <i class="fas fa-exclamation-triangle animate-pulse"></i>
                <h4 class="font-black uppercase text-xs tracking-widest">Out of Stock</h4>
            </div>
            <ul class="space-y-1">
                @foreach($outOfStockProducts as $p)
                    <li class="text-sm text-red-800 flex justify-between border-b border-red-100 pb-1">
                        <span>{{ $p->name }}</span>
                        <span class="font-bold">0 units</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Low Stock (ជិតអស់ស្តុក) --}}
        @if($lowStockProducts->count() > 0)
        <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-2xl shadow-sm">
            <div class="flex items-center gap-3 mb-3 text-orange-700">
                <i class="fas fa-bell"></i>
                <h4 class="font-black uppercase text-xs tracking-widest">Low Stock Warning</h4>
            </div>
            <ul class="space-y-1">
                @foreach($lowStockProducts as $p)
                    <li class="text-sm text-orange-800 flex justify-between border-b border-orange-100 pb-1">
                        <span>{{ $p->name }}</span>
                        <span class="font-bold">{{ $p->qty }} units left</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif

    {{-- ១. ផ្នែកបង្ហាញតួលេខសរុប (Summary Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        {{-- Revenue --}}
        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-50 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-blue-600">
                <i class="fas fa-dollar-sign text-6xl"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-wallet text-sm"></i>
                    </div>
                    <span class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em]">Total Revenue</span>
                </div>
                <h3 class="text-4xl font-black text-slate-900 tracking-tight">${{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>

        {{-- Orders --}}
        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-50 relative overflow-hidden group text-orange-600">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-shopping-bag text-6xl"></i>
            </div>
            <div class="relative z-10 text-slate-900">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-sm"></i>
                    </div>
                    <span class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em]">Total Orders</span>
                </div>
                <h3 class="text-4xl font-black tracking-tight">{{ $totalOrders }}</h3>
            </div>
        </div>

        {{-- Products --}}
        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-50 relative overflow-hidden group text-green-600">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-laptop text-6xl"></i>
            </div>
            <div class="relative z-10 text-slate-900">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box text-sm"></i>
                    </div>
                    <span class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em]">Active Products</span>
                </div>
                <h3 class="text-4xl font-black tracking-tight">{{ $totalProducts }}</h3>
            </div>
        </div>
    </div>

    {{-- ២. ផ្នែកក្រាបវិភាគ (Charts Section) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
        <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-50">
            <div class="flex items-center justify-between mb-8">
                <h4 class="font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-chart-line text-blue-500"></i> Sales Trend (Last 7 Days)
                </h4>
                <a href="{{ route('admin.reports.sales') }}" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-widest">View Full Report</a>
            </div>
            <canvas id="salesChart" height="250"></canvas>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-50">
            <div class="flex items-center justify-between mb-8">
                <h4 class="font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-purple-500"></i> Stock by Category
                </h4>
                <a href="{{ route('admin.reports.stock') }}" class="text-[10px] font-bold text-purple-600 hover:underline uppercase tracking-widest">Manage Stock</a>
            </div>
            <div class="max-w-[280px] mx-auto py-4">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    {{-- ៣. ផ្នែក Quick Links --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.products.index') }}" class="group p-6 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 transition-all shadow-sm">
            <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors">Manage Products →</h4>
            <p class="text-xs text-gray-500 mt-1">បង្កើត, កែប្រែ និងលុបទំនិញក្នុងស្តុក</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="group p-6 bg-white rounded-2xl border border-gray-100 hover:border-orange-200 transition-all shadow-sm">
            <h4 class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">Manage Orders →</h4>
            <p class="text-xs text-gray-500 mt-1">ពិនិត្យ និងបច្ចុប្បន្នភាពស្ថានភាពវិក្កយបត្រ</p>
        </a>

        <a href="{{ route('admin.employees.index') }}" class="group p-6 bg-white rounded-2xl border border-gray-100 hover:border-green-200 transition-all shadow-sm">
            <h4 class="font-bold text-slate-800 group-hover:text-green-600 transition-colors">Manage Employees →</h4>
            <p class="text-xs text-gray-500 mt-1">គ្រប់គ្រងគណនីបុគ្គលិក និងសិទ្ធិប្រើប្រាស់</p>
        </a>
    </div>
</div>

{{-- Script for Charts (ប្រើ Chart.js) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesLabels) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode($salesValues) !!},
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.05)',
                borderWidth: 4,
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                fill: true,
                tension: 0.4
            }]
        },
        options: { 
            responsive: true, 
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                x: { grid: { display: false } }
            }
        }
    });

    const catCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($catLabels) !!},
            datasets: [{
                data: {!! json_encode($catValues) !!},
                backgroundColor: ['#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'],
                hoverOffset: 10,
                borderWidth: 0
            }]
        },
        options: { 
            cutout: '75%', 
            plugins: { 
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { size: 10, weight: 'bold' } } } 
            } 
        }
    });
</script>
@endsection