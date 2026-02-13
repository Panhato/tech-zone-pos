@extends('admin.layout')

@section('title', 'គ្រប់គ្រងទំនិញ | Admin Dashboard')

@section('content')
<div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        
        <div class="px-8 py-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center bg-gradient-to-r from-gray-50 to-white gap-4">
            <div>
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">បញ្ជីទំនិញក្នុងស្តុក</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">គ្រប់គ្រងបរិមាណ តម្លៃ និងព័ត៌មានលម្អិត</p>
            </div>

            <div class="flex gap-3">
                {{-- ចំណាំ៖ ប្រើ admin.products.index សម្រាប់ស្វែងរក --}}
                <form action="{{ route('admin.products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm w-64 transition-all"
                           placeholder="ស្វែងរកទំនិញ...">
                    <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                </form>

                @if(Auth::user()->role === 'super_admin')
                    {{-- ចំណាំ៖ ប្រើ admin.products.create --}}
                    <a href="{{ route('admin.products.create') }}" class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all flex items-center gap-2 active:scale-95 shadow-md">
                        <i class="fas fa-plus-circle"></i>
                        <span class="hidden md:inline">បន្ថែមទំនិញ</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[18px] text-black font-black uppercase tracking-normal bg-gray-50/50">
                        <th class="px-8 py-6 font-black​">ឈ្មោះទំនិញ</th>
                        <th class="px-6 py-6 text-center">ស្តុក (Qty)</th>
                        <th class="px-6 py-6 text-right">តម្លៃលក់ ($)</th>
                        <th class="px-6 py-6 text-center">ប្រភេទ</th>
                        <th class="px-6 py-6 text-center">ក្រុមហ៊ុនផ្គត់ផ្គង់</th>
                        
                        @if(Auth::user()->role === 'super_admin')
                            <th class="px-8 py-6 text-right">សកម្មភាព</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-xl bg-gray-100 border border-gray-200 p-1 flex items-center justify-center overflow-hidden shrink-0">
                                        @if($product->image)
                                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <i class="fas fa-box text-gray-300 text-xl"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm mb-0.5 line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                                            BRAND: <span class="text-slate-600">{{ $product->brand ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                @if($product->qty > 0)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-black border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        {{ $product->qty }} units
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-black border border-red-100">
                                        <i class="fas fa-exclamation-circle"></i> អស់ស្តុក
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-right">
                                <span class="font-black text-slate-700 text-sm">${{ number_format($product->price, 2) }}</span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                    {{ $product->category->name ?? 'General' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 {{ $product->supplier ? 'bg-blue-50 text-blue-600' : 'bg-gray-50 text-gray-600' }} rounded-full text-[12px] font-bold uppercase tracking-wide">
                                    {{ $product->supplier->company_name ?? 'N/A' }}
                                </span>
                            </td>

                           @if(Auth::user()->role === 'super_admin')
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    {{-- ១. ប៊ូតុងកែប្រែ (ពណ៌ខៀវស្រាល មាន Icon ច្បាស់) --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                    class="group w-10 h-10 flex items-center justify-center rounded-xl border border-blue-1000 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:shadow-blue-200 transition-all duration-200"
                                    title="កែប្រែ">
                                        {{-- ប្ដូរមកប្រើ fa-edit វិញ --}}
                                        <i class="fas fa-edit text-sm group-hover:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- ២. ប៊ូតុងលុប (ពណ៌ក្រហមស្រាល មាន Icon ច្បាស់) --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបទំនិញនេះមែនទេ? ការលុបមិនអាចត្រឡប់វិញបានទេ។')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="group w-10 h-10 flex items-center justify-center rounded-xl border border-red-3000 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white hover:shadow-lg hover:shadow-red-200 transition-all duration-200"
                                                title="លុបចោល">
                                            {{-- ប្ដូរមកប្រើ fa-trash វិញ --}}
                                            <i class="fas fa-trash text-sm group-hover:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'super_admin' ? '5' : '4' }}" class="px-8 py-24 text-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 ring-8 ring-gray-50/50">
                                    <i class="fas fa-boxes text-3xl"></i>
                                </div>
                                <h3 class="text-blue-600 font-bold">មិនទាន់មានទិន្នន័យទំនិញ</h3>
                                @if(Auth::user()->role === 'super_admin')
                                    <p class="text-gray-700 text-sm mt-1">សូមចុចប៊ូតុង "បន្ថែមទំនិញ" ដើម្បីចាប់ផ្តើម។</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/30">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection