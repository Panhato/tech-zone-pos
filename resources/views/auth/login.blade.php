<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style> body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <nav class="fixed w-full z-50 top-0 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('shop.index') }}" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                <i class="fas fa-microchip"></i> TECH ZONE
            </a>
            <a href="{{route('shop.index') }}" class="text-gray-500 hover:text-blue-600">
                <i class="fas fa-arrow-left"></i> ត្រឡប់ទៅហាង
            </a>
        </div>
    </nav>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100 mt-16">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-900">ស្វាគមន៍មកកាន់វិញ!</h1>
            <p class="text-gray-500 mt-2">សូមបញ្ចូលគណនីរបស់អ្នកដើម្បីបន្ត</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST"> 
            @csrf
            
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm italic">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">អ៊ីមែល</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="example@gmail.com" 
                        class="w-full pl-10 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition bg-gray-50">
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">ពាក្យសម្ងាត់</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="password" name="password" required
                        placeholder="••••••••" 
                        class="w-full pl-10 pr-4 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition bg-gray-50">
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="mr-2 rounded text-blue-600 focus:ring-blue-500">
                    ចងចាំខ្ញុំ
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">ភ្លេចពាក្យសម្ងាត់?</a>
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-1">
                ចូលប្រើប្រាស់ (Login)
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
            មិនទាន់មានគណនីមែនទេ? 
            <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">ចុះឈ្មោះបង្កើតថ្មី</a>
        </div>
    </div>

</body>
</html>