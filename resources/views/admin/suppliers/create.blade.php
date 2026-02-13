@extends('admin.layout')

@section('title', 'បន្ថែមក្រុមហ៊ុនផ្គត់ផ្គង់ | Admin')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-800">បន្ថែមក្រុមហ៊ុនផ្គត់ផ្គង់ថ្មី</h2>
            <a href="{{ route('admin.suppliers.index') }}" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <form action="{{ route('admin.suppliers.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- ឈ្មោះក្រុមហ៊ុន --}}
            <div>
                <label class="block text-sm font-bold mb-2 text-slate-700">ឈ្មោះក្រុមហ៊ុន <span class="text-red-500">*</span></label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" 
                       class="w-full px-4 py-3 border @error('company_name') border-red-500 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                       placeholder="ឧទាហរណ៍: ASUS, Apple..." required>
                @error('company_name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- ឈ្មោះអ្នកទំនាក់ទំនង (កន្លែងដែលធ្លាប់ Error) --}}
            <div>
                <label class="block text-sm font-bold mb-2 text-slate-700">ឈ្មោះអ្នកទំនាក់ទំនង <span class="text-red-500">*</span></label>
                <input type="text" name="contact_name" value="{{ old('contact_name') }}" 
                       class="w-full px-4 py-3 border @error('contact_name') border-red-500 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                       placeholder="ឈ្មោះបុគ្គលិកតំណាង" required>
                @error('contact_name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- លេខទូរស័ព្ទ --}}
            <div>
                <label class="block text-sm font-bold mb-2 text-slate-700">លេខទូរស័ព្ទ <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" 
                       class="w-full px-4 py-3 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                       placeholder="012 345 678" required>
                @error('phone') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- អាសយដ្ឋាន --}}
            <div>
                <label class="block text-sm font-bold mb-2 text-slate-700">អាសយដ្ឋាន</label>
                <textarea name="address" rows="3" 
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                          placeholder="ទីតាំងក្រុមហ៊ុន...">{{ old('address') }}</textarea>
            </div>

            {{-- ប៊ូតុង Action --}}
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all active:scale-95">
                    រក្សាទុកទិន្នន័យ
                </button>
                <a href="{{ route('admin.suppliers.index') }}" class="flex-1 bg-gray-100 text-gray-500 py-4 rounded-xl font-bold hover:bg-gray-200 hover:text-gray-700 transition-all text-center">
                    បោះបង់
                </a>
            </div>
        </form>
    </div>
</div>
@endsection