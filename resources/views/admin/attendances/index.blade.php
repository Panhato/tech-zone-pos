@extends('admin.layout')

@section('title', 'កត់ត្រាវត្តមាន | Real-time')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    
    @if(session('success'))
        <div class="fixed top-24 right-6 z-50 animate-bounce-in">
            <div class="bg-white border-l-4 border-green-500 shadow-2xl rounded-lg p-4 flex items-center gap-3 pr-10">
                <div class="bg-green-100 rounded-full p-2 text-green-600">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">ជោគជ័យ!</h4>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 right-6 z-50 animate-bounce-in">
            <div class="bg-white border-l-4 border-red-500 shadow-2xl rounded-lg p-4 flex items-center gap-3 pr-10">
                <div class="bg-red-100 rounded-full p-2 text-red-600">
                    <i class="fas fa-times"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">បរាជ័យ!</h4>
                    <p class="text-sm text-gray-600">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <div class="w-full lg:w-1/3 sticky top-28">
            <div class="bg-white rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-white/50 overflow-hidden relative">
                
                <div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500"></div>
                <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

                <div class="relative z-10 px-8 pt-10 pb-8 text-center">
                    <div class="relative inline-block mb-4">
                        <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-black text-blue-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-400 border-4 border-white rounded-full"></div>
                    </div>

                    <h2 class="text-2xl font-black text-white drop-shadow-md">{{ Auth::user()->name }}</h2>
                    <p class="text-blue-100 text-sm font-medium tracking-wider uppercase mt-1">
                        {{ \App\Models\Employee::where('user_id', Auth::id())->first()->position ?? 'Staff Member' }}
                    </p>

                    <div class="mt-8 bg-white/90 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/50">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-[0.2em] mb-2">ម៉ោងបច្ចុប្បន្ន</p>
                        <div class="text-4xl font-black text-slate-800 tabular-nums tracking-tight" id="liveClock">
                            --:--:--
                        </div>
                        <p class="text-blue-500 font-bold text-sm mt-1">{{ date('l, d F Y') }}</p>
                    </div>

                    <form action="{{ route('admin.attendances.store') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="group relative w-full flex items-center justify-center gap-3 bg-slate-900 hover:bg-blue-600 text-white py-5 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-blue-500/30 active:scale-95">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-colors">
                                <i class="fas fa-fingerprint text-xl"></i>
                            </div>
                            <div class="text-left">
                                <span class="block text-[10px] text-gray-400 group-hover:text-blue-100 uppercase tracking-wider font-bold">ចុចទីនេះដើម្បី</span>
                                <span class="block text-lg font-bold leading-none">កត់ត្រាវត្តមាន</span>
                            </div>
                        </button>
                    </form>

                    <div class="mt-6 flex justify-between text-xs font-bold text-gray-400 border-t border-gray-100 pt-4">
                        <span>ចូល: <span class="text-slate-700">08:00 AM</span></span>
                        <span>ចេញ: <span class="text-slate-700">05:00 PM</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800">វត្តមានថ្ងៃនេះ</h3>
                        <p class="text-sm text-gray-500 mt-1">បញ្ជីបុគ្គលិកដែលបានស្កេនរួចរាល់</p>
                    </div>
                    <div class="hidden md:block px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-600 shadow-sm">
                        <i class="fas fa-users text-blue-500 mr-2"></i> សរុប: {{ count($attendances) }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[11px] text-gray-400 font-black uppercase tracking-wider bg-white border-b border-gray-100">
                                <th class="px-8 py-6">ឈ្មោះបុគ្គលិក</th>
                                <th class="px-6 py-6 text-center">ម៉ោងចូល</th>
                                <th class="px-6 py-6 text-center">ម៉ោងចេញ</th>
                                <th class="px-8 py-6 text-right">ស្ថានភាព</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($attendances as $row)
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-600 font-bold text-sm shadow-sm">
                                                {{ substr($row->employee->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800 text-sm">{{ $row->employee->name }}</p>
                                                <p class="text-[10px] text-gray-400 uppercase font-bold">{{ $row->employee->position }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-50 text-green-700 border border-green-100 text-xs font-bold shadow-sm">
                                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                            {{ \Carbon\Carbon::parse($row->check_in)->format('h:i:s A') }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-center">
                                        @if($row->check_out)
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-50 text-gray-600 border border-gray-200 text-xs font-bold">
                                                <i class="fas fa-check"></i>
                                                {{ \Carbon\Carbon::parse($row->check_out)->format('h:i:s A') }}
                                            </span>
                                        @else
                                            <span class="text-[10px] text-gray-300 font-bold italic tracking-wider">--:--:--</span>
                                        @endif
                                    </td>

                                    <td class="px-8 py-5 text-right">
                                        <span class="px-4 py-1.5 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest shadow-md shadow-blue-200">
                                            {{ $row->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                            <i class="fas fa-history text-2xl"></i>
                                        </div>
                                        <p class="text-gray-400 font-bold text-sm">មិនទាន់មានទិន្នន័យសម្រាប់ថ្ងៃនេះ</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        hours = String(hours).padStart(2, '0');

        const timeString = `${hours}:${minutes}:${seconds} <span class="text-lg text-gray-400 ml-1">${ampm}</span>`;
        document.getElementById('liveClock').innerHTML = timeString;
    }

    // Update every second
    setInterval(updateClock, 1000);
    // Run immediately
    updateClock();
</script>
@endsection