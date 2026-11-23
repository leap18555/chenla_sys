<?php

use Illuminate\Http\Request;
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

// ដាក់ Prefix ឈ្មោះ 'api.' រួមគ្នា ដើម្បីកុំឱ្យ apiResource ជាន់ឈ្មោះជាមួយ web.php
Route::name('api.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public & Guest API Routes
    |--------------------------------------------------------------------------
    */

    // Public Endpoints
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/exchange', 'index')->name('exchange');
    });

    // Authentication Routes (Guest)
    Route::controller(UserController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated API Routes (Laravel Sanctum)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth:sanctum'])->group(function () {

        // Logout Route
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');

        // User Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Dashboards (ភ្ជាប់ទៅកាន់ Method ដែលមានស្រាប់ក្នុង Controller)
        Route::get('/admin-dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user/home', [UserController::class, 'dashboard'])->name('user.home');

        // Authors API Resource
        Route::apiResource('authors', AuthorController::class);

        /*
        |--------------------------------------------------------------------------
        | Permission Protected System API Routes
        |--------------------------------------------------------------------------
        */

        // Borrowers / Customers Management
        Route::middleware(['can:view-borrowers'])->group(function () {
            Route::apiResource('customers', CustomersController::class);
        });

        // Loan & Collateral Management
        Route::middleware(['can:manage-loans'])->group(function () {
            Route::apiResource('loans', LoanController::class);
            Route::apiResource('collaterals', CollateralController::class);
            Route::apiResource('repayments', RepaymentController::class);

            // Transactions & Deposits
            Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
            Route::apiResource('deposits', DepositsController::class)->only(['index', 'store']);
        });

        // Reports
        Route::middleware(['can:view-reports'])->group(function () {
            Route::get('/reports', function () {
                return response()->json([
                    'status' => 'success',
                    'data'   => [],
                ]);
            })->name('reports.index');
        });

        // System Audit Logs
        Route::middleware(['can:view-audit-logs'])->group(function () {
            Route::get('/audit-logs', function () {
                return response()->json([
                    'status' => 'success',
                    'data'   => [],
                ]);
            })->name('audit-logs.index');
        });

        // Staff & User Management
        Route::middleware(['can:view-roles'])->group(function () {
            Route::apiResource('staff', StaffController::class);
            Route::apiResource('roles', RoleController::class);
        });

    });

});
