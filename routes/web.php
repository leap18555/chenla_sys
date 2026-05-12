<?php
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DepositsController;


// Route::get('/', function () {
//     return view('page.dashboard');
// });

// Forntend 
Route::controller(ProductsController::class)->group(function(){
    // home page
    Route::get('/','home')->name('home');
    Route::get('/exchange', [ProductsController::class, 'index'])->name('exchange');
});
// Login and Registser
Route::controller(UserController::class)->group(function(){
    Route::get('/login','ShowLogin')->name('login');
    Route::post('/login','login')->name('login');

    Route::get('/register','ShowRegister')->name('register');
    Route::post('/register','register')->name('register');
});

// Profile account
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Example of a named route definition
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')->middleware('auth');

Route::resource('authors', AuthorController::class);


/*
|--------------------------------------------------------------------------
| Bank Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Loan Management
    |--------------------------------------------------------------------------
    */


Route::middleware(['auth'])->group(function () {
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}', [LoanController::class, 'show'])->name('loans.show');
    Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::put('/loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
});



    /*
    |--------------------------------------------------------------------------
    | Transactions
    |--------------------------------------------------------------------------
    */
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
});
// Customers
Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
// The Detail Page Route
Route::get('customers/{id}', [CustomersController::class, 'show'])->name('customers.show');



// Deposits Route


Route::get('/deposits', [DepositsController::class, 'index'])->name('deposits.index');
Route::get('/deposits/create', [DepositsController::class, 'create'])->name('deposits.create');
Route::post('/deposits', [DepositsController::class, 'store'])->name('deposits.store');


// Staff list

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');

// Create staff form
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');

// Store new staff
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');

// Show staff profile
Route::get('/staff/{staff}', [StaffController::class, 'show'])->name('staff.show');

// Edit staff form
Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');

// Update staff
Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');

// Delete staff
Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

 
