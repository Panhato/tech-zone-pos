@extends('admin.layout')

@section('title', 'ប្រតិបត្តិការស្តុក | Admin')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Inventory Transactions</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">តាមដានរាល់ចលនាចូល-ចេញ និងការខូចខាតទំនិញ</p>
        </div>
        <div class="flex gap-3">
            {{-- ប៊ូតុងសម្រាប់ Export ឬ Filter --}}
            <button class="bg-white border border-gray-200 text-slate-700 px-5 py-2.5 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all flex items-center gap-2 shadow-sm">
                <i class="fas fa-file-export text-blue-500"></i> Export
            </button>
            {{-- យើងនឹងបង្កើត Form បន្ថែមប្រតិបត្តិការនៅជំហានបន្ទាប់ --}}
            <button class="bg-slate-900 text-white px-5 py-2.5 rounded-2xl font-bold text-sm hover:bg-blue-600 transition-all flex items-center gap-2 shadow-lg shadow-blue-100">
                <i class="fas fa-plus-circle"></i> New Transaction
            </button>
        </div>
    </div>

    {{-- តារាងបង្ហាញប្រតិបត្តិការ --}}
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">
                        <th class="px-8 py-5 border-b">Date & Time</th>
                        <th class="px-6 py-5 border-b">Product</th>
                        <th class="px-6 py-5 border-b text-center">Type</th>
                        <th class="px-6 py-5 border-b text-center">Qty</th>
                        <th class="px-6 py-5 border-b">Handled By</th>
                        <th class="px-8 py-5 border-b">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-blue-50/30 transition-all group">
                        <td class="px-8 py-5 text-sm text-gray-500 font-medium">
                            {{ $transaction->created_at->format('d M Y, H:i A') }}
                        </td>
                        <td class="px-6 py-5 font-bold text-slate-800">
                            {{ $transaction->product->name ?? 'Unknown' }}
                        </td>
                        <td class="px-6 py-5 text-center">
                            @php
                                $colors = [
                                    'in' => 'bg-green-100 text-green-700 border-green-200',
                                    'out' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'broken' => 'bg-red-100 text-red-700 border-red-200',
                                    'transfer' => 'bg-purple-100 text-purple-700 border-purple-200',
                                ];
                                $labels = ['in' => 'STOCK IN', 'out' => 'STOCK OUT', 'broken' => 'BROKEN', 'transfer' => 'TRANSFER'];
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black border {{ $colors[$transaction->type] }}">
                                {{ $labels[$transaction->type] }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center font-black {{ $transaction->type == 'in' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $transaction->type == 'in' ? '+' : '-' }}{{ $transaction->quantity }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center text-[10px] font-bold text-gray-600 border border-gray-200">
                                    {{ substr($transaction->user->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-xs font-bold text-gray-600">{{ $transaction->user->name ?? 'System' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-400 italic">
                            {{ $transaction->note ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 ring-8 ring-gray-50/50">
                                <i class="fas fa-exchange-alt text-2xl"></i>
                            </div>
                            <p class="text-gray-400 font-bold">No transactions recorded yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($transactions->hasPages())
        <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/30">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection