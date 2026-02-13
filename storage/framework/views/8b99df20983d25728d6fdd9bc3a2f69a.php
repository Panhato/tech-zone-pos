

<?php $__env->startSection('title', 'Orders | Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="bg-white rounded-3xl shadow p-6">
        <h3 class="text-xl font-bold mb-4">Order Management</h3>
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->customer_name); ?></td>
                        <td>$<?php echo e(number_format($order->total_price, 2)); ?></td>
                        <td><?php echo e($order->status); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="text-blue-600">View</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($orders->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>