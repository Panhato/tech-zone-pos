<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Tech Zone</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4 md:px-6 pt-32 pb-16">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 italic uppercase">Checkout</h1>
            <p class="text-gray-500 mt-2 font-medium">សូមបំពេញព័ត៌មានដឹកជញ្ជូនរបស់អ្នកដើម្បីបញ្ចប់ការបញ្ជាទិញ។</p>
        </div>

        <form action="<?php echo e(route('checkout.place')); ?>" method="POST">
            <?php echo csrf_field(); ?> 
            <div class="flex flex-col lg:flex-row gap-8">
                
                
                <div class="w-full lg:w-2/3">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-6 flex items-center gap-3 text-blue-700 uppercase tracking-tight">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-sm"></i>
                            </div>
                            ព័ត៌មានអ្នកទទួល
                        </h2>

                        <?php if($errors->any()): ?>
                            <div class="mb-6 bg-red-50 border border-red-100 text-red-600 px-5 py-4 rounded-2xl text-sm">
                                <ul class="font-medium">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><i class="fas fa-exclamation-circle mr-2"></i> <?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-400 font-bold uppercase text-[10px] mb-2 tracking-widest">ឈ្មោះរបស់អ្នក <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name', Auth::user()->name ?? '')); ?>" 
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition font-medium" 
                                       placeholder="បញ្ចូលឈ្មោះ..." required>
                            </div>

                            <div>
                                <label class="block text-gray-400 font-bold uppercase text-[10px] mb-2 tracking-widest">លេខទូរស័ព្ទ <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" 
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition font-medium" 
                                       placeholder="012 xxx xxx" required>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-gray-400 font-bold uppercase text-[10px] mb-2 tracking-widest">អាសយដ្ឋានដឹកជញ្ជូន <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="3" 
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition font-medium" 
                                      placeholder="ផ្ទះលេខ, ផ្លូវ, សង្កាត់, ខណ្ឌ..." required><?php echo e(old('address')); ?></textarea>
                        </div>

                        <h2 class="text-xl font-bold mb-6 flex items-center gap-3 text-blue-700 pt-6 border-t border-gray-50 uppercase tracking-tight">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-wallet text-sm"></i>
                            </div>
                            វិធីសាស្ត្រទូទាត់
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative border-2 border-blue-500 bg-blue-50/30 p-5 rounded-2xl cursor-pointer flex items-center gap-4 transition hover:bg-blue-50 shadow-sm shadow-blue-100">
                                <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <p class="font-bold text-slate-800">បង់ប្រាក់ពេលទទួល (COD)</p>
                                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Cash on Delivery</p>
                                </div>
                                <i class="fas fa-money-bill-wave text-green-500 text-xl ml-auto"></i>
                            </label>

                            <label class="relative border border-gray-100 p-5 rounded-2xl cursor-pointer flex items-center gap-4 transition hover:border-blue-300 hover:bg-gray-50 shadow-sm">
                                <input type="radio" name="payment_method" value="khqr" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <p class="font-bold text-slate-800">KHQR / ABA</p>
                                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Scan to Pay</p>
                                </div>
                                <i class="fas fa-qrcode text-blue-600 text-xl ml-auto"></i>
                            </label>
                        </div>
                    </div>
                </div>

                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-50 sticky top-32">
                        <h3 class="text-lg font-black text-slate-800 mb-6 border-b pb-4 uppercase italic">Order Summary</h3>

                        <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                            <?php $total = 0; ?>
                            <?php if(session('cart')): ?>
                                <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total += $details['price'] * $details['quantity']; ?>
                                    <div class="flex items-center gap-4 py-2 border-b border-gray-50 last:border-0">
                                        
                                        <div class="w-16 h-16 bg-gray-50 rounded-xl flex-shrink-0 overflow-hidden border border-gray-100">
                                            <?php if(isset($details['image']) && $details['image']): ?>
                                                
                                                <img src="<?php echo e(asset('storage/' . $details['image'])); ?>" 
                                                     alt="<?php echo e($details['name']); ?>" 
                                                     class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="flex items-center justify-center h-full text-gray-300">
                                                    <i class="fas fa-laptop text-xl"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-sm text-slate-900 truncate"><?php echo e($details['name']); ?></p>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">QTY: <?php echo e($details['quantity']); ?></p>
                                        </div>

                                        <div class="font-bold text-slate-800 text-sm">
                                            $<?php echo e(number_format($details['price'] * $details['quantity'], 2)); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="space-y-3 border-t border-gray-50 pt-6 text-sm">
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>តម្លៃទំនិញសរុប</span>
                                <span class="font-bold text-slate-800">$<?php echo e(number_format($total, 2)); ?></span>
                            </div>
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>ថ្លៃដឹកជញ្ជូន</span>
                                <span class="text-green-600 font-black italic">FREE</span>
                            </div>
                        </div>

                        <div class="border-t-2 border-dashed border-gray-100 my-6"></div>

                        <div class="flex justify-between items-end mb-8">
                            <span class="text-slate-400 font-bold uppercase text-xs tracking-widest">Total Amount</span>
                            <span class="text-3xl font-black text-blue-600">$<?php echo e(number_format($total, 2)); ?></span>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-600 hover:shadow-2xl shadow-lg shadow-gray-200 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 group">
                            <span>Place Order</span>
                            <i class="fas fa-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        
                        <p class="text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-6">
                            <i class="fas fa-shield-alt mr-1 text-green-500"></i> Secure Checkout
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
</html><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/checkout.blade.php ENDPATH**/ ?>