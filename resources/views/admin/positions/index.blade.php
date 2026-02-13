@extends('admin.layout')

@section('title', 'គ្រប់គ្រងតំណែង | Admin')

@section('content')
<div class="container mx-auto">
    {{-- Header Section --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-800 italic uppercase">Employee Positions</h2>
            <p class="text-sm text-gray-500 font-medium">គ្រប់គ្រងតួនាទី និងភារកិច្ចរបស់បុគ្គលិក</p>
        </div>
        <button onclick="document.getElementById('posModal').classList.remove('hidden')" class="bg-blue-600 text-white px-6 py-2.5 rounded-2xl font-bold text-sm shadow-lg shadow-blue-100 transition-all hover:bg-blue-700">
            <i class="fas fa-plus-circle mr-2"></i> Add New Position
        </button>
    </div>

    {{-- Table Section --}}
    @if($positions->count() > 0)
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-400 tracking-widest">
                    <tr>
                        <th class="px-8 py-5 border-b">ID</th>
                        <th class="px-8 py-5 border-b">Position Name</th>
                        <th class="px-8 py-5 border-b">Description</th>
                        <th class="px-8 py-5 border-b text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($positions as $pos)
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="px-8 py-5 text-gray-400 font-medium text-xs">#{{ $pos->id }}</td>
                        <td class="px-8 py-5 font-bold text-slate-800">{{ $pos->name }}</td>
                        <td class="px-8 py-5 text-sm text-gray-500">{{ $pos->description ?? '---' }}</td>
                        <td class="px-8 py-5 text-right flex justify-end gap-3">
                            <button class="text-blue-500 hover:text-blue-700 font-bold text-xs uppercase tracking-tighter transition-colors">Edit</button>
                            <form action="{{ route('admin.positions.destroy', $pos->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបតំណែងនេះឬ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-xs uppercase tracking-tighter transition-colors">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white p-16 rounded-3xl shadow-xl border border-gray-100 text-center">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300 text-4xl">
                <i class="fas fa-user-tie"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800">មិនទាន់មានទិន្នន័យតំណែងនៅឡើយ</h3>
            <p class="text-gray-500 text-sm mt-2 max-w-xs mx-auto leading-relaxed">ចាប់ផ្តើមបង្កើតតំណែងដំបូងសម្រាប់អាជីវកម្មរបស់អ្នក ដើម្បីងាយស្រួលគ្រប់គ្រងបុគ្គលិក។</p>
        </div>
    @endif
</div>

{{-- Add Modal --}}
<div id="posModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md mx-4 animate-in fade-in zoom-in duration-200">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-user-tie"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800">Add New Position</h3>
        </div>

        <form action="{{ route('admin.positions.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Position Name</label>
                    <input type="text" name="name" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-800" placeholder="e.g. IT Manager" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Description</label>
                    <textarea name="description" rows="3" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-800" placeholder="តួនាទី និងភារកិច្ចសង្ខេប..."></textarea>
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black transition-all hover:bg-blue-600 shadow-lg shadow-gray-200">
                    Save Position
                </button>
                <button type="button" onclick="document.getElementById('posModal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-500 py-4 rounded-2xl font-bold transition-all hover:bg-gray-200">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection