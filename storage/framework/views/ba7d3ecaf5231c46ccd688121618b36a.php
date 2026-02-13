

<?php $__env->startSection('title', 'ប្រតិបត្តិការស្តុក | Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Inventory Transactions</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">តាមដានរាល់ចលនាចូល-ចេញ និងការខូចខាតទំនិញ</p>
        </div>
        <div class="flex gap-3">
            
            <button class="bg-white border border-gray-200 text-slate-700 px-5 py-2.5 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all flex items-center gap-2 shadow-sm">
                <i class="fas fa-file-export text-blue-500"></i> Export
            </button>
            
            <button class="bg-slate-900 text-white px-5 py-2.5 rounded-2xl font-bold text-sm hover:bg-blue-600 transition-all flex items-center gap-2 shadow-lg shadow-blue-100">
                <i class="fas fa-plus-circle"></i> New Transaction
            </button>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">
                        <th class="px-8 py-5 border-b">Date & Time</th>
                        <th class="px-6 py-5 border-b">Product</th>
                        <th class="px-6 py-5 border-b text-center">Type</th>
                        <th class="px-6 py-5 border-b text-center">Qty</th>
                        <th class="px-6 py-5 border-b">Handled By</th>
                        <th class="px-8 py-5 border-b">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-blue-50/30 transition-all group">
                        <td class="px-8 py-5 text-sm text-gray-500 font-medium">
                            <?php echo e($transaction->created_at->format('d M Y, H:i A')); ?>

                        </td>
                        <td class="px-6 py-5 font-bold text-slate-800">
                            <?php echo e($transaction->product->name ?? 'Unknown'); ?>

                        </td>
                        <td class="px-6 py-5 text-center">
                            <?php
                                $colors = [
                                    'in' => 'bg-green-100 text-green-700 border-green-200',
                                    'out' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'broken' => 'bg-red-100 text-red-700 border-red-200',
                                    'transfer' => 'bg-purple-100 text-purple-700 border-purple-200',
                                ];
                                $labels = ['in' => 'STOCK IN', 'out' => 'STOCK OUT', 'broken' => 'BROKEN', 'transfer' => 'TRANSFER'];
                            ?>
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black border <?php echo e($colors[$transaction->type]); ?>">
                                <?php echo e($labels[$transaction->type]); ?>

                            </span>
                        </td>
                        <td class="px-6 py-5 text-center font-black <?php echo e($transaction->type == 'in' ? 'text-green-600' : 'text-red-500'); ?>">
                            <?php echo e($transaction->type == 'in' ? '+' : '-'); ?><?php echo e($transaction->quantity); ?>

                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center text-[10px] font-bold text-gray-600 border border-gray-200">
                                    <?php echo e(substr($transaction->user->name ?? 'A', 0, 1)); ?>

                                </div>
                                <span class="text-xs font-bold text-gray-600"><?php echo e($transaction->user->name ?? 'System'); ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-400 italic">
                            <?php echo e($transaction->note ?? '-'); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 ring-8 ring-gray-50/50">
                                <i class="fas fa-exchange-alt text-2xl"></i>
                            </div>
                            <p class="text-gray-400 font-bold">No transactions recorded yet.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($transactions->hasPages()): ?>
        <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/30">
            <?php echo e($transactions->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/reports/transactions.blade.php ENDPATH**/ ?>