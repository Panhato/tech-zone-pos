<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-800">

    @include('partials.navbar')

    <div class="container mx-auto px-6 pt-32 pb-16">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">ទាក់ទងមកពួកយើង</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                យើងរង់ចាំស្វាគមន៍រាល់សំណួរ និងមតិយោបល់របស់អ្នក។
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-start">
            
            <div class="w-full lg:w-1/3 space-y-6">
                
                <div class="flex items-center p-5 rounded-2xl bg-blue-50 hover:bg-blue-100 transition duration-300 border border-blue-100/50">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white text-lg flex-shrink-0 shadow-md shadow-blue-300/50">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-bold text-gray-900">លេខទូរស័ព្ទ</h3>
                        <p class="text-gray-600 text-sm">012 345 678 / 098 765 432</p>
                    </div>
                </div>

                <div class="flex items-center p-5 rounded-2xl bg-purple-50 hover:bg-purple-100 transition duration-300 border border-purple-100/50">
                    <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white text-lg flex-shrink-0 shadow-md shadow-purple-300/50">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-bold text-gray-900">អ៊ីមែល</h3>
                        <p class="text-gray-600 text-sm">support@techzone.com</p>
                    </div>
                </div>

                <div class="flex items-center p-5 rounded-2xl bg-green-50 hover:bg-green-100 transition duration-300 border border-green-100/50">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white text-lg flex-shrink-0 shadow-md shadow-green-300/50">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-bold text-gray-900">ទីតាំងហាង</h3>
                        <p class="text-gray-600 text-sm leading-tight">ផ្ទះលេខ ១២៣, មហាវិថីកម្ពុជាក្រោម, រាជធានីភ្នំពេញ</p>
                    </div>
                </div>

                <div class="pt-6 flex justify-start space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-pink-600 hover:text-white hover:border-pink-600 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-blue-400 hover:text-white hover:border-blue-400 transition"><i class="fab fa-telegram-plane"></i></a>
                </div>
            </div>

            <div class="w-full lg:w-2/3 bg-white border border-gray-100 p-8 md:p-10 rounded-3xl shadow-xl shadow-gray-200/40">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">ផ្ញើសារមកកាន់យើង</h2>
                
                <form action="#" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">ឈ្មោះរបស់អ្នក</label>
                            <input type="text" placeholder="បញ្ចូលឈ្មោះ" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 transition outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">លេខទូរស័ព្ទ</label>
                            <input type="text" placeholder="បញ្ចូលលេខទូរស័ព្ទ" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 transition outline-none text-sm">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">អ៊ីមែល</label>
                        <input type="email" placeholder="example@gmail.com" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 transition outline-none text-sm">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">សាររបស់អ្នក</label>
                        <textarea rows="4" placeholder="សរសេរសារ..." class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 transition outline-none text-sm"></textarea>
                    </div>

                    <button type="button" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition transform hover:-translate-y-1 shadow-md text-base">
                        ផ្ញើសារឥឡូវនេះ
                    </button>
                </form>
            </div>

        </div>
    </div>

    <div class="w-full h-80 bg-gray-100 grayscale hover:grayscale-0 transition duration-500">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250151.1512101655!2d104.75010160279647!3d11.579666934905756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525cb!2sPhnom%20Penh!5e0!3m2!1sen!2skh!4v1707755555555!5m2!1sen!2skh" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

    <footer class="bg-white border-t py-8 text-center text-sm text-gray-500">
        <p>© 2026 Tech Zone Computer Shop. All rights reserved.</p>
    </footer>

</body>
</html>