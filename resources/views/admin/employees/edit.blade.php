@extends('admin.layout')

@section('title', 'កែប្រែព័ត៌មានបុគ្គលិក | Admin')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12 flex justify-center">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        
        {{-- Header ផ្នែកខាងលើ --}}
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-white/5 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-md shadow-inner border border-white/30">
                    <i class="fas fa-user-edit text-3xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight">កែប្រែព័ត៌មានបុគ្គលិក</h2>
                <p class="text-blue-100 text-sm mt-2 font-medium">
                    កំពុងកែប្រែទិន្នន័យរបស់៖ <span class="bg-white/20 px-2 py-0.5 rounded text-white">{{ $employee->name }}</span>
                </p>
            </div>
        </div>

        {{-- Form កែប្រែ --}}
        <div class="p-10">
            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') {{-- សំខាន់ណាស់សម្រាប់ Update Data --}}
                
                {{-- ឈ្មោះពេញ --}}
                <div class="space-y-2">
                    <label class="block text-slate-700 font-bold text-sm uppercase tracking-wide">
                        <i class="fas fa-user text-blue-500 mr-1"></i> ឈ្មោះពេញ <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $employee->name) }}" 
                           class="w-full px-5 py-4 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-800" 
                           placeholder="បញ្ចូលឈ្មោះបុគ្គលិក" required>
                    @error('name') 
                        <p class="text-red-500 text-xs font-bold mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> 
                    @enderror
                </div>

                {{-- តួនាទី --}}
                <div class="space-y-2">
                    <label class="block text-slate-700 font-bold text-sm uppercase tracking-wide">
                        <i class="fas fa-briefcase text-blue-500 mr-1"></i> តួនាទី/ផ្នែក <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="position" value="{{ old('position', $employee->position) }}" 
                           class="w-full px-5 py-4 bg-gray-50 border @error('position') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-800" 
                           placeholder="ឧទាហរណ៍: General Manager, Sales..." required>
                    @error('position') 
                        <p class="text-red-500 text-xs font-bold mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> 
                    @enderror
                </div>

                {{-- លេខទូរស័ព្ទ --}}
                <div class="space-y-2">
                    <label class="block text-slate-700 font-bold text-sm uppercase tracking-wide">
                        <i class="fas fa-phone text-blue-500 mr-1"></i> លេខទូរស័ព្ទ
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" 
                           class="w-full px-5 py-4 bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-800" 
                           placeholder="012 345 678">
                    @error('phone') 
                        <p class="text-red-500 text-xs font-bold mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> 
                    @enderror
                </div>

                {{-- ប៊ូតុង Action --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-50 mt-4">
                    <button type="submit" class="flex-[2] bg-slate-900 text-white py-4 rounded-2xl font-black hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-200 transition-all active:scale-95 shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> រក្សាទុកការកែប្រែ
                    </button>
                    
                    <a href="{{ route('admin.employees.index') }}" class="flex-1 bg-gray-100 text-gray-500 py-4 rounded-2xl font-bold hover:bg-gray-200 hover:text-gray-700 transition-all text-center">
                        បោះបង់
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection