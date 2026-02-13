

<?php $__env->startSection('title', 'របាយការណ៍ស្តុក | Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 italic">Stock Inventory Report</h2>
        <button onclick="window.print()" class="bg-slate-800 text-white px-4 py-2 rounded-xl font-bold text-sm">
            <i class="fas fa-print mr-2"></i> Print Report
        </button>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] uppercase tracking-widest text-gray-400 font-bold">
                    <th class="px-6 py-4">Product Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4 text-center">In Stock</th>
                    <th class="px-6 py-4 text-center">Price ($)</th>
                    <th class="px-6 py-4 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="px-6 py-4 font-bold text-slate-800"><?php echo e($product->name); ?></td>
                    <td class="px-6 py-4 text-gray-500"><?php echo e($product->category->name ?? 'N/A'); ?></td>
                    <td class="px-6 py-4 text-center font-bold"><?php echo e($product->qty); ?></td>
                    <td class="px-6 py-4 text-center text-blue-600 font-bold">$<?php echo e(number_format($product->price, 2)); ?></td>
                    <td class="px-6 py-4 text-right">
                        <?php if($product->qty <= 5): ?>
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-bold">LOW STOCK</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold">AVAILABLE</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/reports/stock.blade.php ENDPATH**/ ?>