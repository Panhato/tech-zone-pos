@extends('admin.layout')

@section('title', 'បន្ថែមប្រតិបត្តិការស្តុក | Admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-800 italic">New Stock Transaction</h2>
        <p class="text-gray-500 text-sm font-medium">បញ្ចូលទំនិញថ្មី ឬកត់ត្រាទំនិញដែលខូចខាត</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
        <form action="{{ route('admin.transactions.store') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- ជ្រើសរើសទំនិញ --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Select Product</label>
                <select name="product_id" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none font-medium" required>
                    <option value="">--- រើសទំនិញ ---</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (ស្តុកបច្ចុប្បន្ន: {{ $product->qty }})</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                {{-- ប្រភេទ --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Type</label>
                    <select name="type" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none font-medium" required>
                        <option value="in">STOCK IN (បញ្ចូលថ្មី)</option>
                        <option value="broken">BROKEN (ទំនិញខូច)</option>
                    </select>
                </div>
                {{-- ចំនួន --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Quantity</label>
                    <input type="number" name="quantity" min="1" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none font-medium" placeholder="0" required>
                </div>
            </div>

            {{-- កំណត់សម្គាល់ --}}
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Note (Optional)</label>
                <textarea name="note" rows="3" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none font-medium" placeholder="បញ្ជាក់មូលហេតុ..."></textarea>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black hover:bg-blue-600 transition-all shadow-lg shadow-blue-100">
                    Submit Transaction
                </button>
                <a href="{{ route('admin.reports.transactions') }}" class="flex-1 bg-gray-100 text-gray-500 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection