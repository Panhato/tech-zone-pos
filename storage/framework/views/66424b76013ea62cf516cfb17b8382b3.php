

<?php $__env->startSection('title', 'Order Details #' . $order->id); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto max-w-5xl">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="hover:text-blue-600 transition">Orders</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-blue-600">Details</span>
            </nav>
            <h2 class="text-3xl font-black text-slate-900 italic uppercase tracking-tight">
                Order <span class="text-blue-600">#<?php echo e($order->id); ?></span>
            </h2>
        </div>
        
        
        <div class="px-6 py-2 rounded-2xl font-black uppercase italic text-xs tracking-widest border
            <?php if($order->status == 'pending'): ?> bg-orange-50 text-orange-500 border-orange-100
            <?php elseif($order->status == 'processing'): ?> bg-blue-50 text-blue-500 border-blue-100
            <?php elseif($order->status == 'completed'): ?> bg-emerald-50 text-emerald-500 border-emerald-100
            <?php else: ?> bg-gray-50 text-gray-500 border-gray-100 <?php endif; ?>">
            Current Status: <?php echo e($order->status); ?>

        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-8">
            
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 border-b pb-4 italic">Customer Details</h3>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-user text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Name</p>
                            <p class="font-bold text-slate-800"><?php echo e($order->customer_name); ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-phone text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Phone</p>
                            <p class="font-bold text-slate-800"><?php echo e($order->customer_phone); ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Address</p>
                            <p class="font-bold text-slate-800 text-sm leading-relaxed"><?php echo e($order->customer_address); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-slate-900 p-8 rounded-[32px] shadow-2xl text-white">
                <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-6 italic">Control Status</h3>
                <form action="<?php echo e(route('admin.orders.update', $order->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="space-y-4">
                        <select name="status" class="w-full px-5 py-4 bg-slate-800 border border-slate-700 rounded-2xl outline-none focus:border-blue-500 transition font-bold text-xs appearance-none cursor-pointer text-slate-300">
                            <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>Processing</option>
                            <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                            <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-900/40">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="lg:col-span-2">
            <div class="bg-white p-8 md:p-10 rounded-[32px] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 border-b pb-5 italic">Purchased Items</h3>
                
                <div class="space-y-6">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-6 group">
                        
                        <div class="w-20 h-20 bg-slate-50 rounded-[22px] flex-shrink-0 flex items-center justify-center border border-slate-100 group-hover:border-blue-200 transition duration-300">
                            <i class="fas fa-laptop text-2xl text-slate-200 group-hover:text-blue-200 transition"></i>
                        </div>

                        
                        <div class="flex-1 min-w-0">
                            <h4 class="font-black text-slate-800 uppercase italic tracking-tight mb-2 truncate"><?php echo e($item->product_name); ?></h4>
                            <div class="flex items-center gap-3">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-lg border border-slate-100">
                                    QTY: <span class="text-blue-600"><?php echo e($item->quantity); ?></span>
                                </span>
                                <span class="text-xs font-bold text-slate-500">@ $<?php echo e(number_format($item->price, 2)); ?></span>
                            </div>
                        </div>

                        
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Subtotal</p>
                            <p class="font-black text-slate-900 italic tracking-tight">$<?php echo e(number_format($item->price * $item->quantity, 2)); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mt-12 pt-8 border-t-2 border-dashed border-slate-50 flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2 font-bold">Total Payment</p>
                        <p class="text-4xl font-black text-blue-600 italic tracking-tighter">$<?php echo e(number_format($order->total_price, 2)); ?></p>
                    </div>
                    <div class="text-right text-slate-300 text-[9px] font-bold uppercase tracking-widest hidden md:block">
                        <i class="fas fa-shield-alt mr-1 text-blue-500/20"></i> TECH ZONE Verified Order
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>