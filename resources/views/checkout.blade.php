<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Tech Zone</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .checkout-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .checkout-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800">

    @include('partials.navbar')

    <div class="container mx-auto px-4 md:px-6 pt-36 pb-20">
        
        {{-- Page Header --}}
        <div class="mb-10">
            <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Shop</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-blue-600">Checkout</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 italic uppercase tracking-tight">Secure <span class="text-blue-600">Checkout</span></h1>
            <p class="text-slate-500 mt-2 font-medium">សូមបំពេញព័ត៌មានដឹកជញ្ជូនរបស់អ្នកដើម្បីបញ្ចប់ការបញ្ជាទិញ។</p>
        </div>

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf 
            <div class="flex flex-col lg:flex-row gap-10">
                
                {{-- ផ្នែកខាងឆ្វេង៖ ព័ត៌មានអតិថិជន និងការបង់ប្រាក់ --}}
                <div class="w-full lg:w-[65%] space-y-8">
                    <div class="bg-white p-8 md:p-10 rounded-[32px] shadow-sm border border-slate-100 checkout-card">
                        <h2 class="text-xl font-black mb-8 flex items-center gap-4 text-slate-900 uppercase italic">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                                <i class="fas fa-truck-fast text-lg"></i>
                            </div>
                            Shipping Information
                        </h2>

                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-5 rounded-2xl flex items-start gap-4 animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 mt-1"></i>
                                <ul class="text-sm font-bold text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" 
                                       class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition font-bold text-slate-700" 
                                       placeholder="បញ្ចូលឈ្មោះ..." required>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" 
                                       class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition font-bold text-slate-700" 
                                       placeholder="012 xxx xxx" required>
                            </div>
                        </div>

                        <div class="space-y-2 mb-10">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Shipping Address <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="3" 
                                      class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition font-bold text-slate-700" 
                                      placeholder="ផ្ទះលេខ, ផ្លូវ, សង្កាត់, ខណ្ឌ..." required>{{ old('address') }}</textarea>
                        </div>

                        <h2 class="text-xl font-black mb-8 flex items-center gap-4 text-slate-900 pt-8 border-t border-slate-50 uppercase italic">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                                <i class="fas fa-wallet text-lg"></i>
                            </div>
                            Payment Method
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <label class="relative group flex items-center p-6 border-2 border-slate-100 rounded-[24px] cursor-pointer hover:border-blue-500 hover:bg-blue-50/10 transition-all shadow-sm">
                                <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <div class="ml-5">
                                    <p class="font-black text-slate-800 uppercase italic text-sm tracking-tight">Cash on Delivery</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">បង់ប្រាក់ពេលទទួល</p>
                                </div>
                                <i class="fas fa-money-bill-wave text-emerald-500 text-xl ml-auto opacity-40 group-hover:opacity-100 transition"></i>
                            </label>

                            <label class="relative group flex items-center p-6 border-2 border-slate-100 rounded-[24px] cursor-pointer hover:border-blue-500 hover:bg-blue-50/10 transition-all shadow-sm">
                                <input type="radio" name="payment_method" value="khqr" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <div class="ml-5">
                                    <p class="font-black text-slate-800 uppercase italic text-sm tracking-tight">KHQR / ABA Pay</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">ស្កេនដើម្បីបង់ប្រាក់</p>
                                </div>
                                <i class="fas fa-qrcode text-blue-600 text-xl ml-auto opacity-40 group-hover:opacity-100 transition"></i>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- ផ្នែកខាងស្តាំ៖ សេចក្ដីសង្ខេបការកុម្ម៉ង់ --}}
                <div class="w-full lg:w-[35%]">
                    <div class="bg-slate-900 p-8 rounded-[32px] shadow-2xl sticky top-32 overflow-hidden">
                        {{-- Decor --}}
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl"></div>
                        
                        <h3 class="text-lg font-black text-white mb-8 border-b border-slate-800 pb-6 uppercase italic tracking-widest flex items-center justify-between relative z-10">
                            Order Summary
                            <span class="text-[10px] bg-blue-600 text-white px-3 py-1 rounded-full not-italic tracking-normal">{{ count(session('cart', [])) }} Items</span>
                        </h3>

                        <div class="space-y-6 mb-10 max-h-80 overflow-y-auto pr-2 custom-scrollbar relative z-10">
                            @php $total = 0; @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <div class="flex items-center gap-5 group">
                                        {{-- បង្ហាញរូបភាពផលិតផល --}}
                                        <div class="w-20 h-20 bg-slate-800 rounded-2xl flex-shrink-0 overflow-hidden border border-slate-700 group-hover:border-blue-500/50 transition duration-300">
                                            @if(isset($details['image']) && $details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" 
                                                     alt="{{ $details['name'] }}" 
                                                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                            @else
                                                <div class="flex items-center justify-center h-full text-slate-600">
                                                    <i class="fas fa-laptop text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-white text-sm truncate uppercase tracking-tight">{{ $details['name'] }}</p>
                                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">QTY: <span class="text-blue-400">{{ $details['quantity'] }}</span></p>
                                            <p class="text-xs font-black text-slate-400 mt-2">${{ number_format($details['price'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="space-y-4 border-t border-slate-800 pt-8 relative z-10">
                            <div class="flex justify-between text-slate-500 text-xs font-black uppercase tracking-widest">
                                <span>Subtotal</span>
                                <span class="text-slate-200">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-500 text-xs font-black uppercase tracking-widest">
                                <span>Shipping Fee</span>
                                <span class="text-emerald-500 italic font-black">FREE</span>
                            </div>
                            
                            <div class="pt-6 mt-4 flex justify-between items-end">
                                <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Total Amount</span>
                                <span class="text-4xl font-black text-white italic tracking-tighter">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-6 rounded-2xl font-black uppercase tracking-[0.2em] hover:bg-blue-500 hover:shadow-[0_20px_40px_rgba(37,99,235,0.3)] transition-all transform hover:-translate-y-1 mt-10 flex items-center justify-center gap-3 group relative z-10">
                            <span>Place Order</span>
                            <i class="fas fa-arrow-right-long text-sm group-hover:translate-x-2 transition-transform"></i>
                        </button>
                        
                        <div class="mt-8 pt-8 border-t border-slate-800 flex items-center justify-center gap-4 grayscale opacity-30 relative z-10">
                            <i class="fa-brands fa-cc-visa text-2xl text-white"></i>
                            <i class="fa-brands fa-cc-mastercard text-2xl text-white"></i>
                            <span class="text-[8px] font-black text-white uppercase tracking-widest">SSL Encrypted</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
</html>