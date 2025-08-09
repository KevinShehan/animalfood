<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Change Password Routes
    Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.change.update');
    
    // Admin Routes
    Route::prefix('admin')->group(function () {
        // Products
        Route::get('/products', function () {
            return view('admin.products.index');
        })->name('admin.products');
        
        // Inventory
        Route::get('/inventory', function () {
            return view('admin.inventory.index');
        })->name('admin.inventory');
        
        // Orders
        Route::get('/orders', function () {
            return view('admin.orders.index');
        })->name('admin.orders');
        
        // Customers CRUD
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers');
        Route::post('/customers', [CustomerController::class, 'store']);
        Route::get('/customers/{customer}', [CustomerController::class, 'show']);
        Route::put('/customers/{customer}', [CustomerController::class, 'update']);
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
        
        // Suppliers CRUD
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('admin.suppliers');
        Route::post('/suppliers', [SupplierController::class, 'store']);
        Route::get('/suppliers/{supplier}', [SupplierController::class, 'show']);
        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update']);
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);
        
        // Users CRUD
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        
        // Billing
        Route::get('/billing', function () {
            return view('admin.billing.index');
        })->name('admin.billing');
        
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
    });
});

require __DIR__.'/auth.php';
