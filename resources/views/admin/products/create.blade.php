@extends('admin.layout')

@section('title', 'បន្ថែមទំនិញថ្មី | Admin Dashboard')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">បន្ថែមទំនិញថ្មី</h3>
                <p class="text-gray-500 mt-1">បំពេញព័ត៌មានខាងក្រោមដើម្បីដាក់បញ្ចូលទំនិញក្នុងស្តុក</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-blue-600 font-bold transition-colors">
                <i class="fas fa-arrow-left"></i>
                ត្រឡប់ក្រោយ
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            {{-- ចំណាំ៖ ត្រូវប្រើ enctype="multipart/form-data" ដើម្បីអាច Upload រូបភាពបាន --}}
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- ឈ្មោះទំនិញ --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ឈ្មោះទំនិញ <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full px-5 py-4 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="ឧទាហរណ៍៖ ROG Strix G16" required>
                        @error('name') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- ម៉ាក (Brand) --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ម៉ាក (Brand)</label>
                        <input type="text" name="brand" value="{{ old('brand') }}" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="ឧទាហរណ៍៖ ASUS">
                    </div>

                    {{-- ប្រភេទទំនិញ --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ប្រភេទទំនិញ <span class="text-red-500">*</span></label>
                        <select name="category_id" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" required>
                            <option value="">--- រើសប្រភេទ ---</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ក្រុមហ៊ុនផ្គត់ផ្គង់ --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ក្រុមហ៊ុនផ្គត់ផ្គង់</label>
                        <select name="supplier_id" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium">
                            <option value="">--- រើសក្រុមហ៊ុនផ្គត់ផ្គង់ ---</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- តម្លៃលក់ --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">តម្លៃលក់ ($) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" 
                               class="w-full px-5 py-4 bg-gray-50 border @error('price') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="0.00" required>
                    </div>

                    {{-- បរិមាណ --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">បរិមាណ (Qty) <span class="text-red-500">*</span></label>
                        <input type="number" name="qty" value="{{ old('qty', 0) }}" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="0" required>
                    </div>

                    {{-- រូបភាព --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">រូបភាពទំនិញ</label>
                        <input type="file" name="image" 
                               class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                        <p class="text-[10px] text-gray-400 font-bold">ប្រភេទឯកសារ៖ JPG, PNG, WEBP (ទំហំមិនលើសពី 2MB)</p>
                    </div>

                    {{-- PROMOTION SECTION (Added) --}}
                    <div class="col-span-full mt-2 p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h4 class="font-bold text-blue-900">ការកំណត់ Promotion (មិនដាក់ក៏បាន)</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Discount Percent --}}
                            <div>
                                <label class="block text-xs font-bold mb-2 text-slate-600 uppercase">បញ្ចុះតម្លៃ (%)</label>
                                <div class="relative">
                                    <input type="number" name="discount_percent" 
                                           value="{{ old('discount_percent') }}" 
                                           class="w-full pl-4 pr-10 py-3 bg-white border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-blue-600"
                                           min="0" max="100" placeholder="0">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-blue-400 font-black">%</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Discount End Date --}}
                            <div>
                                <label class="block text-xs font-bold mb-2 text-slate-600 uppercase">ថ្ងៃផុតកំណត់ Promotion</label>
                                <input type="date" name="discount_end_date" 
                                       value="{{ old('discount_end_date') }}" 
                                       class="w-full px-4 py-3 bg-white border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium text-slate-600">
                            </div>
                        </div>
                    </div>

                    {{-- ការពិពណ៌នា --}}
                    <div class="col-span-full space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ការពិពណ៌នា (Description)</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                                  placeholder="ព័ត៌មានលម្អិតពីទំនិញ...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-4 border-t border-gray-50 pt-8">
                    <button type="submit" class="flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-200 transition-all active:scale-95">
                        <i class="fas fa-save mr-2"></i> រក្សាទុកទំនិញ
                    </button>
                    <button type="reset" class="px-8 py-4 bg-gray-100 text-gray-500 rounded-2xl font-black hover:bg-gray-200 transition-all">
                        សម្អាតទិន្នន័យ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection