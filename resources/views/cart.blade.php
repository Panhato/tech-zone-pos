<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style> body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    @include('partials.navbar')

    <div class="container mx-auto px-6 pt-32 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">កន្ត្រកទំនិញ</h1>
                <p class="text-gray-500">អ្នកមានទំនិញចំនួន <span class="font-bold text-blue-600">{{ count((array) session('cart')) }}</span> នៅក្នុងកន្ត្រក</p>
            </div>
            <a href="{{ route('order.history') }}" class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-blue-600 hover:bg-blue-50 transition shadow-sm font-semibold text-sm">
                <i class="fas fa-history text-xs"></i> ប្រវត្តិការទិញ
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-3/4">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="hidden md:grid grid-cols-12 gap-4 p-5 bg-gray-50/50 border-b border-gray-100 text-gray-500 font-bold text-xs uppercase tracking-wider">
                            <div class="col-span-6">ផលិតផល</div>
                            <div class="col-span-2 text-center">តម្លៃ</div>
                            <div class="col-span-2 text-center">ចំនួន</div>
                            <div class="col-span-2 text-right">សរុប</div>
                        </div>

                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-6 items-center border-b border-gray-50 hover:bg-blue-50/20 transition-colors">
                                
                                <div class="col-span-6 flex items-center gap-4">
                                    <div class="w-24 h-24 bg-white border border-gray-100 rounded-2xl flex items-center justify-center p-2 flex-shrink-0 shadow-sm">
                                        {{-- ឆែកមើលរូបភាព៖ បើមានរូបក្នុង storage បង្ហាញរូប បើអត់បង្ហាញ Icon --}}
                                        @if(!empty($details['image']))
                                            <img src="{{ asset('storage/products/' . $details['image']) }}" 
                                                 class="w-full h-full object-contain rounded-lg"
                                                 onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($details['name']) }}&background=F3F4F6&color=9CA3AF&size=128';">
                                        @else
                                            <div class="flex flex-col items-center text-gray-300">
                                                <i class="fas fa-laptop text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-bold text-slate-900 leading-snug hover:text-blue-600 transition">{{ $details['name'] }}</h3>
                                        <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded uppercase font-bold tracking-tighter">{{ $details['brand'] ?? 'Device' }}</span>
                                        
                                        <form action="{{ route('remove_from_cart') }}" method="POST" class="mt-3">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-400 text-xs hover:text-red-600 flex items-center gap-1.5 transition">
                                                <i class="far fa-trash-alt"></i> លុបចេញ
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-span-2 text-center">
                                    <span class="md:hidden text-xs text-gray-400">តម្លៃម្នាក់: </span>
                                    <span class="font-semibold text-gray-600">${{ number_format($details['price'], 2) }}</span>
                                </div>

                                <div class="col-span-2 flex justify-center">
                                    <div class="flex items-center bg-gray-100 rounded-xl px-4 py-1.5">
                                        <span class="text-sm font-bold text-gray-700">{{ $details['quantity'] }}</span>
                                    </div>
                                </div>

                                <div class="col-span-2 text-right">
                                    <span class="md:hidden text-xs text-gray-400">សរុប: </span>
                                    <span class="font-bold text-blue-600 text-lg">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('shop.index') }}" class="group flex items-center gap-2 text-gray-600 hover:text-blue-600 font-bold transition">
                            <i class="fas fa-chevron-left text-xs group-hover:-translate-x-1 transition-transform"></i> ត្រឡប់ទៅទិញបន្ថែម
                        </a>
                    </div>
                @else
                    <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <div class="w-32 h-32 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
                            <i class="fas fa-shopping-basket text-5xl text-blue-400"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-slate-800 mb-3">កន្ត្រករបស់អ្នកនៅទទេ</h3>
                        <p class="text-gray-500 mb-10 max-w-sm mx-auto">អ្នកមិនទាន់បានបន្ថែមទំនិញណាមួយទៅក្នុងកន្ត្រកនៅឡើយទេ។ ស្វែងរកផលិតផលល្អៗឥឡូវនេះ!</p>
                        <a href="{{ route('shop.index') }}" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform hover:-translate-y-1 inline-flex items-center gap-3">
                            <i class="fas fa-shopping-cart"></i> ទៅទិញទំនិញឥឡូវនេះ
                        </a>
                    </div>
                @endif
            </div>

            <div class="w-full lg:w-1/4">
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-gray-50 pb-4 flex items-center gap-2">
                        <i class="fas fa-receipt text-blue-500"></i> សង្ខេបការបញ្ជាទិញ
                    </h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-500">
                            <span class="text-sm font-medium">តម្លៃសរុបទំនិញ</span>
                            <span class="font-bold text-slate-700">${{ number_format($total ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span class="text-sm font-medium">ពន្ធ (VAT 0%)</span>
                            <span class="font-bold text-slate-700">$0.00</span>
                        </div>
                        <div class="h-px bg-gray-100 my-2"></div>
                        <div class="flex justify-between items-center text-slate-900">
                            <span class="text-lg font-bold">សរុបរួម</span>
                            <span class="text-2xl font-extrabold text-blue-600 tracking-tight">${{ number_format($total ?? 0, 2) }}</span>
                        </div>
                    </div>
                    
                    @if(isset($total) && $total > 0)
                        <a href="{{ route('checkout.show') }}" class="group block w-full text-center bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 hover:shadow-2xl shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <i class="fas fa-credit-card"></i> គិតលុយ (Checkout)
                        </a>
                        <p class="text-center text-[10px] text-gray-400 mt-4 uppercase tracking-widest font-bold">សុវត្ថិភាព 100% ក្នុងការទូទាត់</p>
                    @else
                        <button disabled class="w-full bg-gray-100 text-gray-400 py-4 rounded-2xl font-bold cursor-not-allowed">
                            កន្ត្រកទទេ
                        </button>
                    @endif
                    
                    <div class="mt-8 flex justify-center gap-5 text-gray-300 text-2xl">
                        <i class="fab fa-cc-visa hover:text-blue-800 transition-colors"></i>
                        <i class="fab fa-cc-mastercard hover:text-red-500 transition-colors"></i>
                        <i class="fab fa-cc-paypal hover:text-blue-500 transition-colors"></i>
                        <i class="fab fa-cc-apple-pay hover:text-black transition-colors"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>