<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Tech Zone Modern Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* ២. កំណត់ Font Family ឱ្យប្រើ Kantumruy Pro សម្រាប់ភាសាខ្មែរ */
        body { 
            font-family: 'Poppins', 'Kantumruy Pro', sans-serif; 
        }
        
        /* បន្ថែមសម្រាប់ចំណងជើងធំៗ ឱ្យមើលទៅរឹងមាំ */
        h1, h2, h3, h4 {
            font-weight: 700; /* Bold ខ្លាំង */
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="relative pt-24 pb-32 flex content-center items-center justify-center" style="min-height: 50vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style='background-image: url("https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80");'>
            <span id="blackOverlay" class="w-full h-full absolute opacity-60 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <h1 class="text-white font-bold text-5xl">
                            ដំណើររបស់ពួកយើង
                        </h1>
                        <p class="mt-4 text-lg text-gray-200">
                            ស្វែងយល់ពីបេសកកម្ម និងចក្ខុវិស័យនៅពីក្រោយ Tech Zone ដែលជាដៃគូផ្គត់ផ្គង់បច្ចេកវិទ្យាដែលអ្នកទុកចិត្ត។
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-20 bg-gray-50 -mt-24">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center mt-32">
                <div class="w-full md:w-5/12 px-4 mr-auto ml-auto mb-8 md:mb-0">
                    <div class="text-gray-500 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-blue-100">
                        <i class="fas fa-rocket text-xl text-blue-600"></i>
                    </div>
                    <h3 class="text-3xl mb-2 font-bold leading-normal">
                        បង្កើតឡើងដើម្បីអ្នក
                    </h3>
                    <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-600">
                        Tech Zone ត្រូវបានបង្កើតឡើងដោយក្រុមអ្នកជំនាញដែលស្រលាញ់បច្ចេកវិទ្យា។ យើងយល់ថា ការស្វែងរកឧបករណ៍ដែលត្រឹមត្រូវមិនមែនជារឿងងាយស្រួលនោះទេ។
                    </p>
                    <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-600">
                        ចក្ខុវិស័យរបស់យើងគឺធ្វើឱ្យបច្ចេកវិទ្យាទំនើបងាយស្រួលទៅដល់សម្រាប់មនុស្សគ្រប់គ្នា ដោយផ្តល់ជូននូវផលិតផល Original គុណភាពខ្ពស់ ជាមួយតម្លៃដែលសមរម្យ និងការធានាពិតប្រាកដ។
                    </p>
                    <a href="<?php echo e(route('shop.index')); ?>" class="font-bold text-blue-600 hover:text-blue-800 mt-8">
                        មើលផលិតផលរបស់យើង <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-2xl rounded-2xl bg-blue-600 overflow-hidden group">
                        <img alt="..." src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" class="w-full align-middle rounded-t-2xl group-hover:scale-110 transition duration-500">
                        <blockquote class="relative p-8 mb-4">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                                <polygon points="-30,95 583,95 583,65" class="text-blue-600 fill-current"></polygon>
                            </svg>
                            <h4 class="text-xl font-bold text-white">
                                ក្រុមការងារជំនាញ
                            </h4>
                            <p class="text-md font-light mt-2 text-white">
                                យើងប្តេជ្ញាផ្តល់ជូននូវសេវាកម្មអតិថិជនដ៏ល្អបំផុត និងការប្រឹក្សាយោបល់ដោយឥតគិតថ្លៃ។
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-20 pb-32 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center mb-24">
                <div class="w-full lg:w-6/12 px-4">
                    <h2 class="text-4xl font-bold text-gray-900">ហេតុអ្វីជ្រើសរើស Tech Zone?</h2>
                    <p class="text-lg leading-relaxed m-4 text-gray-500">
                        យើងផ្តល់ជូនលើសពីការលក់ផលិតផល គឺយើងផ្តល់ជូននូវទំនុកចិត្ត និងបទពិសោធន៍។
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-2xl border border-gray-100 p-8 hover:-translate-y-2 transition duration-300">
                        <div class="px-4 py-5 flex-auto">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-5 shadow-md rounded-full bg-gradient-to-r from-blue-500 to-blue-600">
                                <i class="fas fa-certificate text-2xl"></i>
                            </div>
                            <h6 class="text-xl font-bold">គុណភាពធានា</h6>
                            <p class="marginTop-2 mb-4 text-gray-500">
                                ផលិតផល Original 100% ពីក្រុមហ៊ុនផ្លូវការ ជាមួយនឹងការធានាត្រឹមត្រូវ។
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-2xl border border-gray-100 p-8 hover:-translate-y-2 transition duration-300">
                        <div class="px-4 py-5 flex-auto">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-5 shadow-md rounded-full bg-gradient-to-r from-purple-500 to-pink-600">
                                <i class="fas fa-shipping-fast text-2xl"></i>
                            </div>
                            <h6 class="text-xl font-bold">ដឹកជញ្ជូនរហ័ស</h6>
                            <p class="marginTop-2 mb-4 text-gray-500">
                                សេវាកម្មដឹកជញ្ជូនប្រកបដោយសុវត្ថិភាព និងរហ័សទាន់ចិត្តទូទាំងប្រទេស។
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-2xl border border-gray-100 p-8 hover:-translate-y-2 transition duration-300">
                        <div class="px-4 py-5 flex-auto">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-5 shadow-md rounded-full bg-gradient-to-r from-green-500 to-teal-600">
                                <i class="fas fa-headset text-2xl"></i>
                            </div>
                            <h6 class="text-xl font-bold">ជំនួយបច្ចេកទេស</h6>
                            <p class="marginTop-2 mb-4 text-gray-500">
                                ក្រុមការងារជំនាញរង់ចាំប្រឹក្សា និងដោះស្រាយបញ្ហារបស់អ្នកយ៉ាងយកចិត្តទុកដាក់។
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-gradient-to-r from-blue-600 to-purple-700 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">ត្រៀមខ្លួនដើម្បីដំឡើងកម្រិតបច្ចេកវិទ្យារបស់អ្នកហើយឬនៅ?</h2>
            <p class="text-blue-100 mb-8 text-lg">ពិនិត្យមើលផលិតផលថ្មីៗដែលទើបនឹងមកដល់ក្នុងស្តុករបស់យើង។</p>
            <a href="<?php echo e(route('shop.index')); ?>" class="bg-white text-blue-700 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-gray-100 transition transform hover:scale-105 inline-block">
                <i class="fas fa-shopping-cart mr-2"></i> ទិញឥឡូវនេះ
            </a>
        </div>
    </div>

    <footer class="bg-white py-10">
        <div class="container mx-auto text-center text-gray-500">
            <p>&copy; 2026 Tech Zone Computer Shop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/about.blade.php ENDPATH**/ ?>