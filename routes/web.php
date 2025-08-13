<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillHeaderController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Registration routes (only for authenticated users)
    Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Change Password Routes
    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.change.update');
    
    // Admin Routes
    Route::prefix('admin')->group(function () {
        // Products CRUD
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        
        // Product alerts and stock management
        Route::get('/products/alerts/low-stock', [ProductController::class, 'lowStockAlerts'])->name('admin.products.low-stock');
        Route::get('/products/alerts/expiring', [ProductController::class, 'expiringSoonAlerts'])->name('admin.products.expiring');
        Route::post('/products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('admin.products.update-stock');
        Route::get('/products/count', [ProductController::class, 'getCounts'])->name('admin.products.count');
        
        // Sales Management
        Route::get('/sales', [SalesController::class, 'index'])->name('admin.sales.index');
        Route::get('/sales/create', [SalesController::class, 'create'])->name('admin.sales.create');
        Route::post('/sales', [SalesController::class, 'store'])->name('admin.sales.store');
        Route::get('/sales/{sale}', [SalesController::class, 'show'])->name('admin.sales.show');
        Route::get('/sales/{sale}/edit', [SalesController::class, 'edit'])->name('admin.sales.edit');
        Route::put('/sales/{sale}', [SalesController::class, 'update'])->name('admin.sales.update');
        Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('admin.sales.destroy');
        Route::post('/sales/{sale}/refund', [SalesController::class, 'refund'])->name('admin.sales.refund');
        Route::get('/sales/stats', [SalesController::class, 'getStats'])->name('admin.sales.stats');
        Route::get('/sales/product/{productId}', [SalesController::class, 'getProductDetails'])->name('admin.sales.product-details');
        
        // Chart Data Routes
        Route::get('/sales/charts/daily', [SalesController::class, 'getDailyChartData'])->name('admin.sales.charts.daily');
        Route::get('/sales/charts/weekly', [SalesController::class, 'getWeeklyChartData'])->name('admin.sales.charts.weekly');
        Route::get('/sales/charts/monthly', [SalesController::class, 'getMonthlyChartData'])->name('admin.sales.charts.monthly');
        Route::get('/sales/charts/products', [SalesController::class, 'getProductChartData'])->name('admin.sales.charts.products');
        
        // Sales Targets
        Route::get('/sales/targets', [SalesController::class, 'targets'])->name('admin.sales.targets');
        Route::post('/sales/targets', [SalesController::class, 'storeTarget'])->name('admin.sales.targets.store');
        
        // Inventory
        Route::get('/inventory', function () {
            return view('admin.inventory.index');
        })->name('admin.inventory');
        
        // Orders CRUD
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
        Route::put('/orders/{order}', [OrderController::class, 'update']);
        Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
        Route::post('/orders/bulk-delete', [OrderController::class, 'bulkDelete'])->name('admin.orders.bulk-delete');
        Route::get('/orders/export', [OrderController::class, 'export'])->name('admin.orders.export');
        
        // Customers CRUD
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::post('/customers', [CustomerController::class, 'store']);
        Route::get('/customers/{customer}', [CustomerController::class, 'show']);
        Route::put('/customers/{customer}', [CustomerController::class, 'update']);
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
        Route::post('/customers/bulk-delete', [CustomerController::class, 'bulkDelete'])->name('admin.customers.bulk-delete');
        Route::get('/customers/export', [CustomerController::class, 'export'])->name('admin.customers.export');
        
        // Suppliers CRUD
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('admin.suppliers');
        Route::post('/suppliers', [SupplierController::class, 'store']);
        Route::get('/suppliers/{supplier}', [SupplierController::class, 'show']);
        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update']);
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);
        
        // Categories CRUD
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::get('/categories/get/all', [CategoryController::class, 'getCategories'])->name('admin.categories.get');
        Route::get('/categories/validate-name', [CategoryController::class, 'validateName'])->name('admin.categories.validate-name');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->where('id', '[0-9]+');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
        
        // Users CRUD
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        
        // Billing
        Route::get('/billing', [BillingController::class, 'index'])->name('admin.billing');
        Route::get('/billing/customers', [BillingController::class, 'getCustomers'])->name('admin.billing.customers');
        Route::get('/billing/products', [BillingController::class, 'getProducts'])->name('admin.billing.products');
        Route::get('/billing/products/{id}', [BillingController::class, 'getProductDetails'])->name('admin.billing.products.details');
        Route::get('/billing/customers/{id}', [BillingController::class, 'getCustomerDetails'])->name('admin.billing.customers.details');
        
        Route::get('/billing/list', function () {
            return view('admin.billing.list');
        })->name('admin.bill.list');
        
        // Reports
        Route::get('/reports', function () {
            return view('admin.reports.index');
        })->name('admin.reports');
        
        Route::get('/reports/sales', function () {
            return view('admin.reports.sales');
        })->name('admin.reports.sales');
        
        Route::get('/reports/customers', function () {
            return view('admin.reports.customers');
        })->name('admin.reports.customers');
        
        Route::get('/reports/suppliers', function () {
            return view('admin.reports.suppliers');
        })->name('admin.reports.suppliers');
        
        Route::get('/reports/inventory', function () {
            return view('admin.reports.inventory');
        })->name('admin.reports.inventory');
        
        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('admin.settings');
        
        // Bill Header Settings
        Route::get('/settings/bill-header', [BillHeaderController::class, 'index'])->name('admin.settings.bill-header');
        Route::post('/settings/bill-header', [BillHeaderController::class, 'store'])->name('admin.settings.bill-header.store');
        Route::put('/settings/bill-header/{billHeader}', [BillHeaderController::class, 'update'])->name('admin.settings.bill-header.update');
        Route::get('/settings/bill-header/active', [BillHeaderController::class, 'getActiveHeader'])->name('admin.settings.bill-header.active');
    });
});

require __DIR__.'/auth.php';
