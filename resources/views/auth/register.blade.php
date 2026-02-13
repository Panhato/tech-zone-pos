<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style> 
        body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; } 
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center text-gray-500 hover:text-slate-900 transition text-sm font-medium gap-2">
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex w-1/2 bg-slate-900 relative items-center justify-center overflow-hidden">
            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-40">
            
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/80 to-purple-900/80"></div>

            <div class="relative z-10 p-12 text-white text-center">
                <div class="mb-6 inline-block p-4 rounded-full glass-effect">
                    <i class="fas fa-microchip text-4xl text-blue-300"></i>
                </div>
                <h2 class="text-4xl font-bold mb-4">ចូលរួមជាមួយ Tech Zone</h2>
                <p class="text-lg text-blue-100 max-w-md mx-auto leading-relaxed">
                    ក្លាយជាសមាជិកថ្ងៃនេះ ដើម្បីទទួលបានការបញ្ចុះតម្លៃពិសេស និងតាមដានផលិតផលបច្ចេកវិទ្យាថ្មីៗមុនគេ។
                </p>
                
                <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-3xl font-bold text-slate-900"><i class="fas fa-microchip text-blue-600"></i> Tech Zone</h1>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">បង្កើតគណនីថ្មី 🚀</h2>
                    <p class="text-gray-500 text-sm">សូមបំពេញព័ត៌មានខាងក្រោមដើម្បីចាប់ផ្តើម</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2 text-sm">ឈ្មោះពេញ</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="far fa-user"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-sm font-medium" placeholder="ឈ្មោះរបស់អ្នក">
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-gray-700 font-semibold mb-2 text-sm">អ៊ីមែល</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="far fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-sm font-medium" placeholder="name@email.com">
                            </div>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 font-semibold mb-2 text-sm">លេខទូរស័ព្ទ</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="fas fa-phone-alt text-xs"></i>
                                </span>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-sm font-medium" placeholder="012 xxx xxx">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-semibold mb-2 text-sm">ពាក្យសម្ងាត់</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-lock text-xs"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-sm font-medium" placeholder="••••••••">
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2 text-sm">បញ្ជាក់ពាក្យសម្ងាត់</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-shield-alt text-xs"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition text-sm font-medium" placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                        <span>ចុះឈ្មោះបង្កើតគណនី</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-8 text-center space-y-4">
                    <p class="text-sm text-gray-500">
                        មានគណនីរួចហើយមែនទេ? 
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:text-blue-700 transition">ចូលប្រើប្រាស់</a>
                    </p>
                    
                    <div class="relative flex py-2 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase">Or</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <a href="{{ route('shop.index') }}" class="inline-flex items-center text-gray-500 hover:text-slate-900 transition text-sm font-medium gap-2">
                        <i class="fas fa-long-arrow-alt-left"></i> ត្រឡប់ទៅទំព័រដើម
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>