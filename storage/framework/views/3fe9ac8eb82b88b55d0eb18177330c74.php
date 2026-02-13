

<?php $__env->startSection('title', 'បន្ថែមទំនិញថ្មី | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">បន្ថែមទំនិញថ្មី</h3>
                <p class="text-gray-500 mt-1">បំពេញព័ត៌មានខាងក្រោមដើម្បីដាក់បញ្ចូលទំនិញក្នុងស្តុក</p>
            </div>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="flex items-center gap-2 text-gray-500 hover:text-blue-600 font-bold transition-colors">
                <i class="fas fa-arrow-left"></i>
                ត្រឡប់ក្រោយ
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            
            <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data" class="p-8 md:p-12">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ឈ្មោះទំនិញ <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="ឧទាហរណ៍៖ ROG Strix G16" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs font-bold mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ម៉ាក (Brand)</label>
                        <input type="text" name="brand" value="<?php echo e(old('brand')); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="ឧទាហរណ៍៖ ASUS">
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ប្រភេទទំនិញ <span class="text-red-500">*</span></label>
                        <select name="category_id" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" required>
                            <option value="">--- រើសប្រភេទ ---</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ក្រុមហ៊ុនផ្គត់ផ្គង់</label>
                        <select name="supplier_id" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium">
                            <option value="">--- រើសក្រុមហ៊ុនផ្គត់ផ្គង់ ---</option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->company_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">តម្លៃលក់ ($) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="price" value="<?php echo e(old('price')); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="0.00" required>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">បរិមាណ (Qty) <span class="text-red-500">*</span></label>
                        <input type="number" name="qty" value="<?php echo e(old('qty', 0)); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                               placeholder="0" required>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">រូបភាពទំនិញ</label>
                        <input type="file" name="image" 
                               class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                        <p class="text-[10px] text-gray-400 font-bold">ប្រភេទឯកសារ៖ JPG, PNG, WEBP (ទំហំមិនលើសពី 2MB)</p>
                    </div>

                    
                    <div class="col-span-full mt-2 p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h4 class="font-bold text-blue-900">ការកំណត់ Promotion (មិនដាក់ក៏បាន)</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-xs font-bold mb-2 text-slate-600 uppercase">បញ្ចុះតម្លៃ (%)</label>
                                <div class="relative">
                                    <input type="number" name="discount_percent" 
                                           value="<?php echo e(old('discount_percent')); ?>" 
                                           class="w-full pl-4 pr-10 py-3 bg-white border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-blue-600"
                                           min="0" max="100" placeholder="0">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-blue-400 font-black">%</span>
                                    </div>
                                </div>
                            </div>

                            
                            <div>
                                <label class="block text-xs font-bold mb-2 text-slate-600 uppercase">ថ្ងៃផុតកំណត់ Promotion</label>
                                <input type="date" name="discount_end_date" 
                                       value="<?php echo e(old('discount_end_date')); ?>" 
                                       class="w-full px-4 py-3 bg-white border border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium text-slate-600">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-span-full space-y-2">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider">ការពិពណ៌នា (Description)</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium" 
                                  placeholder="ព័ត៌មានលម្អិតពីទំនិញ..."><?php echo e(old('description')); ?></textarea>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-4 border-t border-gray-50 pt-8">
                    <button type="submit" class="flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-200 transition-all active:scale-95">
                        <i class="fas fa-save mr-2"></i> រក្សាទុកទំនិញ
                    </button>
                    <button type="reset" class="px-8 py-4 bg-gray-100 text-gray-500 rounded-2xl font-black hover:bg-gray-200 transition-all">
                        សម្អាតទិន្នន័យ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/products/create.blade.php ENDPATH**/ ?>