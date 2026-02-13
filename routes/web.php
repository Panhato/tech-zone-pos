<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StockTransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\CustomerController; // បន្ថែមថ្មីសម្រាប់អតិថិជន

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ១. ផ្នែកសាធារណៈ (Public) ---
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index'); 
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// --- ២. ផ្នែកកន្ត្រកទំនិញ (Cart) ---
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');
Route::get('checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
Route::post('checkout', [CartController::class, 'placeOrder'])->name('checkout.place');

// --- ៣. Authentication ---
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if (in_array(Auth::user()->role, ['super_admin', 'admin'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->intended('/');
    }
    return back()->withErrors(['email' => 'អ៊ីមែល ឬពាក្យសម្ងាត់មិនត្រឹមត្រូវ។']);
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// --- ៤. ផ្នែកសមាជិក (Auth Required) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::match(['put', 'post'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/history', [CartController::class, 'history'])->name('order.history');
});

// --- ៥. ផ្នែកគ្រប់គ្រង (ADMIN PANEL) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Attendances
    Route::resource('attendances', AttendanceController::class)->only(['index', 'store', 'show']);
    
    // Products Index
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');

    // --- ផ្នែក Reports ---
    Route::controller(ReportController::class)->group(function () {
        Route::get('/reports/stock', 'stockReport')->name('reports.stock');
        Route::get('/reports/transactions', 'transactionReport')->name('reports.transactions');
        Route::get('/reports/sales', 'saleReport')->name('reports.sales');
        Route::get('/reports/sales/pdf', 'exportSalePdf')->name('reports.sales.pdf');
    });

    // --- ផ្នែកគ្រប់គ្រងប្រតិបត្តិការស្តុក ---
    Route::controller(StockTransactionController::class)->group(function () {
        Route::get('/transactions/create', 'create')->name('transactions.create');
        Route::post('/transactions', 'store')->name('transactions.store');
    });

    // ផ្នែកសម្រាប់ Super Admin ប៉ុណ្ណោះ
    Route::middleware([\App\Http\Middleware\CheckSuperAdmin::class])->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('positions', PositionController::class);

        // --- គ្រប់គ្រងអតិថិជន (បន្ថែមថ្មី) ---
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customers', 'index')->name('customers.index'); // បញ្ជីអតិថិជន
            Route::get('/customers/{user}', 'show')->name('customers.show'); // ព័ត៌មាន និងប្រវត្តិទិញ
        });
        
        // CRUD ផលិតផល
        Route::controller(AdminProductController::class)->group(function () {
            Route::get('/products/create', 'create')->name('products.create');
            Route::post('/products', 'store')->name('products.store');
            Route::get('/products/{product}/edit', 'edit')->name('products.edit');
            Route::put('/products/{product}', 'update')->name('products.update');
            Route::delete('/products/{product}', 'destroy')->name('products.destroy');
        });

        // Admin order management
        Route::controller(AdminOrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('orders.index');
            Route::get('/orders/{order}', 'show')->name('orders.show');
            Route::put('/orders/{order}', 'update')->name('orders.update');
        });
    });
});