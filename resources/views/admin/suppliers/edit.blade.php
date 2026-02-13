@extends('admin.layout')

@section('title', 'កែប្រែក្រុមហ៊ុនផ្គត់ផ្គង់ | Admin')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
        <h2 class="text-2xl font-bold mb-6">កែប្រែក្រុមហ៊ុនផ្គត់ផ្គង់</h2>
        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold mb-2">ឈ្មោះក្រុមហ៊ុន <span class="text-red-500">*</span></label>
                <input type="text" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">ឈ្មោះអ្នកទំនាក់ទំនង <span class="text-red-500">*</span></label>
                <input type="text" name="contact_name" value="{{ old('contact_name', $supplier->contact_name) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">លេខទូរស័ព្ទ <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">អាសយដ្ឋាន</label>
                <input type="text" name="address" value="{{ old('address', $supplier->address) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl">
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition-all">រក្សាទុក</button>
                <a href="{{ route('admin.suppliers.index') }}" class="flex-1 bg-gray-100 text-gray-600 py-4 rounded-xl font-bold hover:bg-gray-200 transition-all text-center">បោះបង់</a>
            </div>
        </form>
    </div>
</div>
@endsection
