

<?php $__env->startSection('title', 'Suppliers List | Tech Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 pt-6 pb-12">
    
    
    <?php if(session('success')): ?>
        <div class="mb-6 flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-md" role="alert">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-sm"><?php echo e(session('success')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 flex items-center bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-md" role="alert">
            <i class="fas fa-exclamation-triangle text-xl mr-3"></i>
            <div>
                <p class="font-bold">Error!</p>
                <p class="text-sm"><?php echo e(session('error')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        
        
        <div class="px-6 py-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center bg-gray-50 gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-truck text-blue-600"></i>
                    Suppliers List
                </h3>
                <p class="text-sm text-gray-500 mt-1">Manage all supplier information here</p>
            </div>
            
            <?php if(Auth::user()->role === 'super_admin'): ?>
                <a href="<?php echo e(route('admin.suppliers.create')); ?>" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition-all shadow hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Add New</span>
                </a>
            <?php endif; ?>
        </div>

        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                        <th class="px-6 py-4 border-b">Company</th>
                        <th class="px-6 py-4 border-b">Contact Person</th>
                        <th class="px-6 py-4 border-b text-center">Phone</th>
                        <th class="px-6 py-4 border-b">Address</th>
                        <?php if(Auth::user()->role === 'super_admin'): ?>
                            <th class="px-6 py-4 border-b text-right">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50 transition-colors">
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                                        <?php echo e(substr($supplier->company_name, 0, 1)); ?>

                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-base"><?php echo e($supplier->company_name); ?></p>
                                        <p class="text-xs text-gray-500">ID: #<?php echo e($supplier->id); ?></p>
                                    </div>
                                </div>
                            </td>

                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-gray-700 font-medium">
                                    <i class="fas fa-user-circle text-gray-400"></i>
                                    <?php echo e($supplier->contact_name); ?>

                                </div>
                            </td>

                            
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold border border-green-200">
                                    <?php echo e($supplier->phone); ?>

                                </span>
                            </td>

                            
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600 line-clamp-2" title="<?php echo e($supplier->address); ?>">
                                    <?php echo e($supplier->address ?? 'No Address'); ?>

                                </span>
                            </td>

                            
                            <?php if(Auth::user()->role === 'super_admin'): ?>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        
                                        <a href="<?php echo e(route('admin.suppliers.edit', $supplier->id)); ?>" 
                                           class="px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-600 hover:text-white transition-all font-bold text-xs flex items-center gap-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        
                                        <form action="<?php echo e(route('admin.suppliers.destroy', $supplier->id)); ?>" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete <?php echo e($supplier->company_name); ?>?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    class="px-3 py-2 bg-red-100 text-red-700 rounded hover:bg-red-600 hover:text-white transition-all font-bold text-xs flex items-center gap-1">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-3xl text-gray-300"></i>
                                    </div>
                                    <p class="font-bold text-lg">No suppliers found</p>
                                    <p class="text-sm mb-4">Click "Add New" to create one.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($suppliers->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($suppliers->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/suppliers/index.blade.php ENDPATH**/ ?>