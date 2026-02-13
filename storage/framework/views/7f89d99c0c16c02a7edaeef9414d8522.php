

<?php $__env->startSection('title', 'គ្រប់គ្រងទំនិញ | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        
        <div class="px-8 py-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center bg-gradient-to-r from-gray-50 to-white gap-4">
            <div>
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">បញ្ជីទំនិញក្នុងស្តុក</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">គ្រប់គ្រងបរិមាណ តម្លៃ និងព័ត៌មានលម្អិត</p>
            </div>

            <div class="flex gap-3">
                
                <form action="<?php echo e(route('admin.products.index')); ?>" method="GET" class="relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                           class="pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm w-64 transition-all"
                           placeholder="ស្វែងរកទំនិញ...">
                    <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                </form>

                <?php if(Auth::user()->role === 'super_admin'): ?>
                    
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all flex items-center gap-2 active:scale-95 shadow-md">
                        <i class="fas fa-plus-circle"></i>
                        <span class="hidden md:inline">បន្ថែមទំនិញ</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[18px] text-black font-black uppercase tracking-normal bg-gray-50/50">
                        <th class="px-8 py-6 font-black​">ឈ្មោះទំនិញ</th>
                        <th class="px-6 py-6 text-center">ស្តុក (Qty)</th>
                        <th class="px-6 py-6 text-right">តម្លៃលក់ ($)</th>
                        <th class="px-6 py-6 text-center">ប្រភេទ</th>
                        <th class="px-6 py-6 text-center">ក្រុមហ៊ុនផ្គត់ផ្គង់</th>
                        
                        <?php if(Auth::user()->role === 'super_admin'): ?>
                            <th class="px-8 py-6 text-right">សកម្មភាព</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-xl bg-gray-100 border border-gray-200 p-1 flex items-center justify-center overflow-hidden shrink-0">
                                        <?php if($product->image): ?>
                                            <img src="<?php echo e(asset('storage/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover rounded-lg">
                                        <?php else: ?>
                                            <i class="fas fa-box text-gray-300 text-xl"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm mb-0.5 line-clamp-1"><?php echo e($product->name); ?></p>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                                            BRAND: <span class="text-slate-600"><?php echo e($product->brand ?? 'N/A'); ?></span>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <?php if($product->qty > 0): ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-black border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        <?php echo e($product->qty); ?> units
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-black border border-red-100">
                                        <i class="fas fa-exclamation-circle"></i> អស់ស្តុក
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <span class="font-black text-slate-700 text-sm">$<?php echo e(number_format($product->price, 2)); ?></span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                    <?php echo e($product->category->name ?? 'General'); ?>

                                </span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 <?php echo e($product->supplier ? 'bg-blue-50 text-blue-600' : 'bg-gray-50 text-gray-600'); ?> rounded-full text-[12px] font-bold uppercase tracking-wide">
                                    <?php echo e($product->supplier->company_name ?? 'N/A'); ?>

                                </span>
                            </td>

                           <?php if(Auth::user()->role === 'super_admin'): ?>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    
                                    <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" 
                                    class="group w-10 h-10 flex items-center justify-center rounded-xl border border-blue-1000 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:shadow-blue-200 transition-all duration-200"
                                    title="កែប្រែ">
                                        
                                        <i class="fas fa-edit text-sm group-hover:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    
                                    <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបទំនិញនេះមែនទេ? ការលុបមិនអាចត្រឡប់វិញបានទេ។')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="group w-10 h-10 flex items-center justify-center rounded-xl border border-red-3000 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white hover:shadow-lg hover:shadow-red-200 transition-all duration-200"
                                                title="លុបចោល">
                                            
                                            <i class="fas fa-trash text-sm group-hover:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(Auth::user()->role === 'super_admin' ? '5' : '4'); ?>" class="px-8 py-24 text-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 ring-8 ring-gray-50/50">
                                    <i class="fas fa-boxes text-3xl"></i>
                                </div>
                                <h3 class="text-blue-600 font-bold">មិនទាន់មានទិន្នន័យទំនិញ</h3>
                                <?php if(Auth::user()->role === 'super_admin'): ?>
                                    <p class="text-gray-700 text-sm mt-1">សូមចុចប៊ូតុង "បន្ថែមទំនិញ" ដើម្បីចាប់ផ្តើម។</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($products->hasPages()): ?>
            <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/30">
                <?php echo e($products->appends(request()->query())->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/products/index.blade.php ENDPATH**/ ?>