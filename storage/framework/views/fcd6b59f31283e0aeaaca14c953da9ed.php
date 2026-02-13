

<?php $__env->startSection('title', 'ទិញទំនិញ | Tech Zone'); ?>

<?php $__env->startSection('content'); ?>


<div class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
    
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/circuit.png')]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl opacity-20 -mr-20 -mt-20 animate-pulse"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <span class="text-blue-400 font-bold tracking-widest uppercase text-sm mb-2 block">Welcome to Tech Zone</span>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
            បច្ចេកវិទ្យាសម្រាប់ <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">អនាគតរបស់អ្នក</span>
        </h1>
        <p class="text-gray-400 max-w-2xl mx-auto text-lg mb-8">
            ស្វែងរកកុំព្យូទ័រ និងឧបករណ៍អេឡិចត្រូនិចដែលមានគុណភាពខ្ពស់ និងតម្លៃសមរម្យបំផុតនៅទីនេះ។
        </p>
        
        
        <form action="<?php echo e(route('shop.index')); ?>" method="GET" class="max-w-xl mx-auto relative group">
            <div class="absolute inset-0 bg-blue-500 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                   class="relative w-full py-4 pl-6 pr-14 bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-gray-400 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white/20 transition-all shadow-xl"
                   placeholder="ស្វែងរកផលិតផលដែលអ្នកចង់បាន...">
            <button type="submit" class="absolute right-2 top-2 bottom-2 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-500 transition-all shadow-lg">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

<div class="container mx-auto px-6 py-12">
    <div class="flex flex-col lg:flex-row gap-10">
        
        
        <aside class="w-full lg:w-1/4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                <h3 class="font-bold text-slate-800 text-lg mb-6 flex items-center gap-2 pb-4 border-b border-gray-50">
                    <i class="fas fa-th-large text-blue-600"></i> ប្រភេទទំនិញ
                </h3>
                
                <ul class="space-y-2">
                    <li>
                        <a href="<?php echo e(route('shop.index')); ?>" 
                           class="flex items-center justify-between px-4 py-3 rounded-xl transition-all <?php echo e(!request('category') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <span>ទាំងអស់</span>
                            <span class="text-xs bg-white px-2 py-0.5 rounded-md shadow-sm border border-gray-100">ALL</span>
                        </a>
                    </li>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('shop.index', ['category' => $category->id])); ?>" 
                               class="flex items-center justify-between px-4 py-3 rounded-xl transition-all <?php echo e(request('category') == $category->id ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                <span><?php echo e($category->name); ?></span>
                                <span class="text-xs <?php echo e(request('category') == $category->id ? 'bg-blue-200 text-blue-800' : 'bg-gray-100 text-gray-500'); ?> px-2 py-0.5 rounded-md">
                                    <?php echo e($category->products_count ?? 0); ?>

                                </span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </aside>

        
        <main class="w-full lg:w-3/4">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-slate-800">
                    <?php if(request('search')): ?>
                        លទ្ធផលស្វែងរក: "<span class="text-blue-600"><?php echo e(request('search')); ?></span>"
                    <?php elseif(request('category')): ?>
                        ប្រភេទ: <span class="text-blue-600"><?php echo e($categories->firstWhere('id', request('category'))->name ?? ''); ?></span>
                    <?php else: ?>
                        ទំនិញថ្មីៗ
                    <?php endif; ?>
                </h2>
                <span class="text-gray-500 text-sm">បង្ហាញ <?php echo e($products->count()); ?> នៃ <?php echo e($products->total()); ?> ទំនិញ</span>
            </div>

            <?php if($products->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col overflow-hidden relative">
                            
                            
                            <div class="h-56 p-6 bg-gray-50 relative overflow-hidden group-hover:bg-blue-50/30 transition-colors">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/products/' . $product->image)); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-image text-4xl"></i>
                                    </div>
                                <?php endif; ?>

                                
                                <?php if($product->brand): ?>
                                    <span class="absolute top-4 left-4 bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-md">
                                        <?php echo e($product->brand); ?>

                                    </span>
                                <?php endif; ?>

                                
                                <?php if($product->discount_percent > 0 && ($product->discount_end_date == null || $product->discount_end_date >= now())): ?>
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-md animate-pulse">
                                        -<?php echo e($product->discount_percent); ?>%
                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="text-xs text-blue-500 font-bold uppercase mb-2 tracking-wide">
                                    <?php echo e($product->category->name ?? 'General'); ?>

                                </div>
                                <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <?php echo e($product->name); ?>

                                </h3>
                                <p class="text-gray-400 text-sm line-clamp-2 mb-4 flex-grow">
                                    <?php echo e($product->description ?? 'មិនមានការពិពណ៌នា'); ?>

                                </p>
                                
                                
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                    <div class="flex flex-col">
                                        
                                        <?php if($product->discount_percent > 0 && ($product->discount_end_date == null || $product->discount_end_date >= now())): ?>
                                            
                                            <?php
                                                $discountedPrice = $product->price - ($product->price * ($product->discount_percent / 100));
                                            ?>
                                            <span class="text-xs text-gray-400 line-through font-medium">$<?php echo e(number_format($product->price, 2)); ?></span>
                                            <span class="text-xl font-black text-red-600">$<?php echo e(number_format($discountedPrice, 2)); ?></span>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400 font-bold uppercase">តម្លៃ</span>
                                            <span class="text-xl font-black text-slate-800">$<?php echo e(number_format($product->price, 2)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php echo e(route('add_to_cart', $product->id)); ?>" 
                                       class="w-12 h-12 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-lg shadow-slate-200 hover:bg-blue-600 hover:scale-110 hover:shadow-blue-300 transition-all duration-300">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mt-12">
                    <?php echo e($products->appends(request()->query())->links()); ?>

                </div>
            <?php else: ?>
                
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <i class="fas fa-search text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">រកមិនឃើញទំនិញទេ</h3>
                    <p class="text-gray-400 mb-6">សូមព្យាយាមស្វែងរកពាក្យផ្សេង ឬត្រឡប់ទៅមើលទាំងអស់។</p>
                    <a href="<?php echo e(route('shop.index')); ?>" class="inline-block bg-slate-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors shadow-lg">
                        មើលទំនិញទាំងអស់
                    </a>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/shop/index.blade.php ENDPATH**/ ?>