<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <div class="container mx-auto px-6 pt-32 pb-16">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            <div class="w-full md:w-1/3 bg-slate-900 p-10 flex flex-col items-center justify-center text-white">
                <div class="relative group">
                    <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.$user->name }}" 
                         class="w-40 h-40 rounded-full object-cover border-4 border-blue-500 shadow-2xl">
                </div>
                <h2 class="mt-6 text-2xl font-bold">{{ $user->name }}</h2>
                <p class="text-blue-300 text-sm italic">សមាជិកតាំងពី៖ {{ $user->created_at->format('M Y') }}</p>
            </div>

            <div class="w-full md:w-2/3 p-10">
                <h3 class="text-2xl font-bold text-slate-800 mb-8">កែសម្រួលព័ត៌មានផ្ទាល់ខ្លួន</h3>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl">{{ session('success') }}</div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">ប្តូររូបភាព Profile</label>
                            <input type="file" name="avatar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">ឈ្មោះពេញ</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 text-gray-400">អ៊ីមែល (មិនអាចកែបាន)</label>
                            <input type="email" value="{{ $user->email }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">លេខទូរស័ព្ទ</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-blue-600 transition shadow-lg shadow-blue-200">
                            រក្សាទុកការផ្លាស់ប្តូរ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>