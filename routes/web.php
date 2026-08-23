<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\RepaymentController;
use App\Http\Controllers\CollateralController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/
 // Admin Dashboard
    Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])
        ->name('dashboard');

// Public Frontend
Route::controller(ProductsController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/exchange', 'index')->name('exchange');
});

// Redirect default /home requests to dashboard (Fixes the 404 error when logged-in users hit guest routes)
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

// Authentication Routes (សម្រាប់ Guest ដែលមិនទាន់ Login)
    Route::controller(UserController::class)->group(function () {
        Route::get('/login', 'ShowLogin')->name('login');
        Route::post('/login', 'login')->name('login.perform');

        Route::get('/register', 'ShowRegister')->name('register');
        Route::post('/register', 'register')->name('register.perform');
    });


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Logout Route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard
    Route::get('/user/home', function () {
        return view('user.home');
    })->name('user.Home');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Authors Resource
    Route::resource('authors', AuthorController::class);

    /*
    |--------------------------------------------------------------------------
    | Permission Protected System Routes
    |--------------------------------------------------------------------------
    */

    // Borrowers / Customers Management
    Route::middleware(['can:view-borrowers'])->group(function () {
        Route::resource('customers', CustomersController::class);
    });

    // Loan & Collateral Management
    Route::middleware(['can:manage-loans'])->group(function () {
        Route::resource('loans', LoanController::class);
        Route::resource('collaterals', CollateralController::class);
        Route::resource('repayments', RepaymentController::class);

        // Transactions & Deposits
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::resource('deposits', DepositsController::class)->only(['index', 'create', 'store']);
    });

    // Reports
    Route::middleware(['can:view-reports'])->group(function () {
        Route::get('/reports', function () {
            //return view('reports.index');
        })->name('reports.index');
    });

    // System Audit Logs
    Route::middleware(['can:view-audit-logs'])->group(function () {
        Route::get('/audit-logs', function () {
            //return view('audit-logs.index');
        })->name('audit-logs.index');
    });

    // Staff & User Management
    Route::middleware(['can:view-roles'])->group(function () {
        Route::resource('staff', StaffController::class);
        Route::resource('roles', RoleController::class);
    });

});