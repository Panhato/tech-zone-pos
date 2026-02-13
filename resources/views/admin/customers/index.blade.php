@extends('admin.layout')

@section('title', 'Customers List | Admin')

@section('content')
<div class="container mx-auto">
    {{-- Header Section --}}
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-900 italic uppercase tracking-tight">
                Customers <span class="text-blue-600">List</span>
            </h2>
            <p class="text-sm text-slate-400 font-medium mt-1">គ្រប់គ្រង និងមើលព័ត៌មានអតិថិជនទាំងអស់ក្នុងប្រព័ន្ធ</p>
        </div>
        
        {{-- Stats Overview --}}
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-sm"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Customers</p>
                    <p class="text-lg font-black text-slate-800 italic">{{ $customers->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 uppercase text-[10px] font-black text-slate-400 tracking-[0.2em] border-b border-slate-50">
                        <th class="px-8 py-6">Customer Profile</th>
                        <th class="px-8 py-6">Contact Info</th>
                        <th class="px-8 py-6 text-center">Activity</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($customers as $customer)
                    <tr class="group hover:bg-slate-50/30 transition-all duration-300">
                        {{-- Profile Section --}}
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black italic shadow-lg shadow-blue-100 group-hover:scale-110 transition-transform">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-black text-slate-800 uppercase italic tracking-tight group-hover:text-blue-600 transition-colors">{{ $customer->name }}</p>
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mt-0.5">Customer ID: #{{ $customer->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Email Section --}}
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-2 text-slate-500">
                                <i class="far fa-envelope text-xs text-slate-300"></i>
                                <span class="text-sm font-bold tracking-tighter">{{ $customer->email }}</span>
                            </div>
                        </td>

                        {{-- Activity Section --}}
                        <td class="px-8 py-5 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all
                                    @if($customer->orders_count > 0) bg-emerald-50 text-emerald-600 border border-emerald-100
                                    @else bg-slate-50 text-slate-400 border border-slate-100 @endif">
                                    {{ $customer->orders_count }} Orders
                                </span>
                            </div>
                        </td>

                        {{-- Action Section --}}
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-100 transition-all active:scale-95 group/btn">
                                <span>View History</span>
                                <i class="fas fa-arrow-right-long group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200">
                                <i class="fas fa-user-slash text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 uppercase italic">No Customers Found</h3>
                            <p class="text-slate-400 text-sm mt-1">មិនទាន់មានអតិថិជនបានចុះឈ្មោះប្រើប្រាស់នៅឡើយទេ។</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection