<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?></title>
    <?php if(app()->environment('local')): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
    <?php else: ?>
        <link href="/css/app.css" rel="stylesheet">
    <?php endif; ?>
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800">
    
    <div class="min-h-screen flex">
        
        <aside class="w-72 bg-white border-r shadow-sm flex flex-col">
            <div class="p-6 border-b flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <i class="fas fa-microchip text-xl"></i>
                </div>
                <a href="/" class="text-xl font-black text-slate-800 tracking-tight">TECH <span class="text-blue-600">ZONE</span></a>
            </div>
            
            <nav class="p-4 flex-grow overflow-y-auto space-y-1">
                
                <div class="px-4 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Main Menu</div>
                
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="<?php echo e(route('admin.products.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-laptop w-5"></i> Products
                </a>

                <a href="<?php echo e(route('admin.categories.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-tags w-5"></i> Categories
                </a>

                <a href="<?php echo e(route('admin.orders.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-shopping-cart w-5"></i> Orders
                </a>

                
                <div class="px-4 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-50 mt-2">Reports & Stocks</div>

                <a href="<?php echo e(route('admin.reports.sales')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.reports.sales') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-chart-line w-5 text-blue-500"></i> Sale Report
                </a>

                <a href="<?php echo e(route('admin.reports.stock')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.reports.stock') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-boxes w-5 text-orange-500"></i> Stock Report
                </a>

                <a href="<?php echo e(route('admin.reports.transactions')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.reports.transactions') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-exchange-alt w-5 text-green-500"></i> Transactions
                </a>

                
                <div class="px-4 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-50 mt-2">Organization</div>

                
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.customers.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-user-group w-5 text-indigo-500"></i> Customers
                </a>

                <a href="<?php echo e(route('admin.employees.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.employees.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-users w-5"></i> Employees
                </a>

                <a href="<?php echo e(route('admin.positions.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.positions.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-user-tie w-5"></i> Positions
                </a>

                <a href="<?php echo e(route('admin.suppliers.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all hover:bg-gray-50 <?php echo e(request()->routeIs('admin.suppliers.*') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-600'); ?>">
                    <i class="fas fa-truck w-5"></i> Suppliers
                </a>
            </nav>

            
            <div class="p-4 border-t bg-gray-50/50">
                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                        <?php echo e(substr(Auth::user()->name ?? 'A', 0, 1)); ?>

                    </div>
                    <div class="overflow-hidden">
                        <div class="text-sm font-bold text-slate-800 truncate"><?php echo e(Auth::user()->name ?? 'Admin'); ?></div>
                        <div class="text-[10px] text-gray-400 truncate"><?php echo e(Auth::user()->email ?? ''); ?></div>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-2">
                    <?php echo csrf_field(); ?>
                    <button class="w-full text-left px-4 py-2 text-xs font-bold text-red-500 hover:bg-red-50 rounded-lg transition-all">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </aside>

        
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                
                <?php if(session('success')): ?>
                    <div class="mb-6 flex items-center gap-3 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 shadow-sm">
                        <i class="fas fa-check-circle"></i>
                        <span class="text-sm font-bold"><?php echo e(session('success')); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="mb-6 flex items-center gap-3 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100 shadow-sm">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm font-bold"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
</body>
</html><?php /**PATH C:\Users\ASUS ROG\computer-shop\resources\views/admin/layout.blade.php ENDPATH**/ ?>