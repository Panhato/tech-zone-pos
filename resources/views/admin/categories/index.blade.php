@extends('admin.layout')

@section('title', 'គ្រប់គ្រងប្រភេទ | Admin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-800 italic uppercase">Product Categories</h2>
            <p class="text-sm text-gray-500 font-medium">គ្រប់គ្រង និងបែងចែកប្រភេទទំនិញក្នុងហាង</p>
        </div>
        {{-- ប៊ូតុងសម្រាប់បន្ថែម (ហៅ Modal) --}}
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-blue-600 text-white px-6 py-2.5 rounded-2xl font-bold text-sm shadow-lg shadow-blue-100 flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Add New Category
        </button>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-black">
                    <th class="px-8 py-5 border-b">Category Name</th>
                    <th class="px-6 py-5 border-b text-center">Products Count</th>
                    <th class="px-8 py-5 border-b text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($categories as $cat)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-5 font-bold text-slate-800">{{ $cat->name }}</td>
                    <td class="px-6 py-5 text-center">
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">{{ $cat->products_count }} items</span>
                    </td>
                    <td class="px-8 py-5 text-right flex justify-end gap-3">
                        <button class="text-blue-500 hover:text-blue-700 font-bold text-xs">Edit</button>
                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបឬ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 font-bold text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Simple Add Modal --}}
<div id="addModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">
        <h3 class="text-xl font-black mb-4">Add Category</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="w-full px-5 py-4 bg-gray-50 border rounded-2xl mb-4 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Category Name" required>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold">Save</button>
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-500 py-3 rounded-xl font-bold">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection