@extends('admin.layout')

@section('title', 'បន្ថែមបុគ្គលិកថ្មី | Admin')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12 flex justify-center">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 text-white text-center">
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-md">
                <i class="fas fa-user-plus text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold tracking-tight">បន្ថែមបុគ្គលិកថ្មី</h2>
            <p class="text-slate-400 text-sm mt-1 opacity-80">សូមបញ្ចូលព័ត៌មានលម្អិត និងបង្កើតគណនីសម្រាប់បុគ្គលិក</p>
        </div>

        <div class="p-10">
            {{-- Display error messages --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <ul class="list-disc list-inside text-red-600 text-sm font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.employees.store') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- Employee Details Section --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2">ព័ត៌មានផ្ទាល់ខ្លួន</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">ឈ្មោះពេញ <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                class="w-full px-5 py-4 bg-gray-50 border @error('name') border-red-300 @else border-gray-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all font-medium" 
                                placeholder="ឧ. សុខ ចាន់រ៉ូ" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">តួនាទី/ផ្នែក <span class="text-red-500">*</span></label>
                            <input type="text" name="position" value="{{ old('position') }}" 
                                class="w-full px-5 py-4 bg-gray-50 border @error('position') border-red-300 @else border-gray-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all font-medium" 
                                placeholder="ឧ. អ្នកគ្រប់គ្រងឃ្លាំង" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm">លេខទូរស័ព្ទ</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" 
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all font-medium" 
                            placeholder="ឧ. 012 345 678">
                    </div>
                </div>

                {{-- User Account Section --}}
                <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 space-y-6 mt-8">
                    <h3 class="text-blue-800 font-bold flex items-center gap-2 border-b border-blue-200 pb-2">
                        <i class="fas fa-user-lock"></i> បង្កើតគណនីសម្រាប់ Login
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">អ៊ីមែល (សម្រាប់ Login) <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="w-full px-5 py-4 bg-white border @error('email') border-red-300 @else border-gray-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" 
                                placeholder="employee@example.com" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">ពាក្យសម្ងាត់ <span class="text-red-500">*</span></label>
                            <input type="password" name="password" 
                                class="w-full px-5 py-4 bg-white border @error('password') border-red-300 @else border-gray-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" 
                                placeholder="********" required>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="{{ route('admin.employees.index') }}" class="flex-1 bg-gray-100 text-gray-600 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all text-center">
                        បោះបង់
                    </a>
                    <button type="submit" class="flex-[2] bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all active:scale-95 shadow-md">
                        <i class="fas fa-save mr-2 text-sm"></i> រក្សាទុកទិន្នន័យ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection