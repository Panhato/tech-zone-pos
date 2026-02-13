<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Tech Zone'); ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; }
        /* បន្ថែម Animation សម្រាប់ Toast Message */
        @keyframes slideInDown { from { transform: translateY(-100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .animate-slide-in { animation: slideInDown 0.5s ease-out forwards; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    <?php if(session('success')): ?>
        Swal.fire({
            title: 'ជោគជ័យ!',
            text: "<?php echo e(session('success')); ?>",
            icon: 'success',
            confirmButtonText: 'យល់ព្រម',
            confirmButtonColor: '#3085d6',
            timer: 3000 // បិទទៅវិញក្នុងរយៈពេល ៣ វិនាទី
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            title: 'មានបញ្ហា!',
            text: "<?php echo e(session('error')); ?>",
            icon: 'error',
            confirmButtonText: 'បិទ'
        });
    <?php endif; ?>
</script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-grow container mx-auto px-6 py-28 md:py-36">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-gray-500 text-sm">
        <p>© 2026 Tech Zone. All rights reserved.</p>
    </footer>

</body>
</html><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/layouts/app.blade.php ENDPATH**/ ?>