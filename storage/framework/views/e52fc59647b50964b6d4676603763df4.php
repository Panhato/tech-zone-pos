

<?php $__env->startSection('title', 'របាយការណ៍លក់ | Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-6">
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Sales Analytics Report</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">វិភាគចំណូល និងប្រតិបត្តិការលក់តាមកាលបរិច្ឆេទ</p>
        </div>

        <form action="<?php echo e(route('admin.reports.sales')); ?>" method="GET" class="flex flex-wrap md:flex-nowrap items-end gap-3 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Start Date</label>
                <input type="date" name="start_date" value="<?php echo e($startDate); ?>" class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">End Date</label>
                <input type="date" name="end_date" value="<?php echo e($endDate); ?>" class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                Filter
            </button>
        </form>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-3xl shadow-xl shadow-blue-200 text-white">
            <p class="text-blue-100 text-xs font-bold uppercase tracking-widest">Total Sales Revenue</p>
            <h3 class="text-3xl font-black mt-2">$<?php echo e(number_format($totalSales, 2)); ?></h3>
            <div class="mt-4 flex items-center gap-2 text-xs text-blue-200">
                <i class="fas fa-chart-line"></i> ចំណូលសរុបក្នុងចន្លោះថ្ងៃជ្រើសរើស
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Orders Completed</p>
            <h3 class="text-3xl font-black text-slate-800 mt-2"><?php echo e($totalOrders); ?></h3>
            <div class="mt-4 flex items-center gap-2 text-xs text-green-500 font-bold">
                <i class="fas fa-shopping-bag"></i> វិក្កយបត្រសរុប
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Average Order Value</p>
            <h3 class="text-3xl font-black text-slate-800 mt-2">
                $<?php echo e($totalOrders > 0 ? number_format($totalSales / $totalOrders, 2) : '0.00'); ?>

            </h3>
            <div class="mt-4 flex items-center gap-2 text-xs text-purple-500 font-bold">
                <i class="fas fa-calculator"></i> មធ្យមភាគក្នុងមួយវិក្កយបត្រ
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black">
                    <th class="px-8 py-5 border-b">Order ID</th>
                    <th class="px-6 py-5 border-b">Customer</th>
                    <th class="px-6 py-5 border-b">Date</th>
                    <th class="px-6 py-5 border-b text-center">Payment</th>
                    <th class="px-6 py-5 border-b text-right">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-blue-50/30 transition-all group">
                    <td class="px-8 py-5 font-bold text-blue-600 text-sm">#<?php echo e($order->id); ?></td>
                    <td class="px-6 py-5 font-bold text-slate-800"><?php echo e($order->user->name ?? 'Guest'); ?></td>
                    <td class="px-6 py-5 text-sm text-gray-500"><?php echo e($order->created_at->format('d M Y')); ?></td>
                    <td class="px-6 py-5 text-center">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-[10px] font-black border border-green-200 uppercase">
                            Paid
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right font-black text-slate-800">
                        $<?php echo e(number_format($order->total_amount, 2)); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center text-gray-400">
                        <i class="fas fa-search text-4xl mb-4 block opacity-20"></i>
                        មិនមានទិន្នន័យលក់សម្រាប់កាលបរិច្ឆេទនេះទេ។
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>​    
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/reports/sales.blade.php ENDPATH**/ ?>