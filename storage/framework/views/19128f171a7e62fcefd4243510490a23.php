

<?php $__env->startSection('title', 'គ្រប់គ្រងបុគ្គលិក | Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 pt-32 pb-12">
    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl flex items-center gap-3 animate-fade-in-down">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
            <p class="text-green-700 font-bold"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        
        
        <div class="px-8 py-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center bg-gradient-to-r from-gray-50 to-white gap-4">
            <div>
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight underline decoration-blue-500/30">បញ្ជីបុគ្គលិកសរុប</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium italic">គ្រប់គ្រងព័ត៌មាន តួនាទី និងវត្តមានបុគ្គលិកក្នុងប្រព័ន្ធ</p>
            </div>
            <?php if(Auth::user()->role === 'super_admin'): ?>
                <a href="<?php echo e(route('admin.employees.create')); ?>" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all flex items-center gap-3 active:scale-95 shadow-md group">
                    <i class="fas fa-plus-circle text-lg group-hover:rotate-90 transition-transform"></i>
                    បន្ថែមបុគ្គលិកថ្មី
                </a>
            <?php endif; ?>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[15px] text-black font-black uppercase tracking-nasnal   bg-gray-50/50">
                        <th class="px-8 py-6">ព័ត៌មានបុគ្គលិក</th>
                        <th class="px-6 py-6 text-center">តួនាទី / ផ្នែក</th>
                        <th class="px-6 py-6">លេខទូរស័ព្ទ</th>
                        <th class="px-8 py-6 text-right">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-black text-lg shadow-sm group-hover:scale-110 transition-transform">
                                        <?php echo e(mb_substr($employee->name, 0, 1)); ?>

                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-base tracking-tight leading-none mb-1"><?php echo e($employee->name); ?></p>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">ID: #EMP-<?php echo e(str_pad($employee->id, 4, '0', STR_PAD_LEFT)); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-xl text-xs font-black border border-blue-100 uppercase tracking-tighter">
                                    <?php echo e($employee->position); ?>

                                </span>
                            </td>
                            <td class="px-6 py-6 text-gray-500 font-bold text-sm tracking-tighter italic">
                                <i class="fas fa-phone-alt mr-2 text-gray-300"></i> <?php echo e($employee->phone ?? 'ពុំមានទិន្នន័យ'); ?>

                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3">
                                    
                                    <?php if(Auth::user()->role === 'super_admin'): ?>
                                        <a href="<?php echo e(route('admin.employees.edit', $employee->id)); ?>" class="w-10 h-10 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm border border-gray-100 hover:border-blue-200" title="កែប្រែព័ត៌មាន">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        
                                        
                                        <form action="<?php echo e(route('admin.employees.destroy', $employee->id)); ?>" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យបុគ្គលិកនេះចេញពីប្រព័ន្ធមែនទេ?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-gray-100 hover:border-red-200" title="លុបបុគ្គលិក">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-8 py-24 text-center">
                                <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-gray-200 ring-4 ring-gray-50">
                                    <i class="fas fa-users-slash text-4xl"></i>
                                </div>
                                <p class="text-gray-400 font-extrabold italic">ពុំទាន់មានទិន្នន័យបុគ្គលិកនៅក្នុងប្រព័ន្ធនៅឡើយទេ</p>
                                <?php if(Auth::user()->role === 'super_admin'): ?>
                                    <a href="<?php echo e(route('admin.employees.create')); ?>" class="inline-block mt-4 bg-blue-50 text-blue-600 px-6 py-2 rounded-xl font-bold hover:bg-blue-600 hover:text-white transition-all">
                                        ចុចទីនេះដើម្បីបន្ថែមដំបូង
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($employees instanceof \Illuminate\Pagination\LengthAwarePaginator && $employees->hasPages()): ?>
            <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/30">
                <?php echo e($employees->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/employees/index.blade.php ENDPATH**/ ?>