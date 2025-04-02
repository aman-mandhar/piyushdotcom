<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, AuthController, DashboardController, UserController,
    UserLoginLogController, UserProfileController, PropertyController
};

// ------------------------------------
// Public Routes
// ------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------
// Public Property Access (for all)
// ------------------------------------
Route::get('/properties', [PropertyController::class, 'indexAll'])->name('properties.indexall');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');

// ------------------------------------
// Authenticated User Routes (Customers)
// ------------------------------------
Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');

    Route::get('/properties', [PropertyController::class, 'indexCustomer'])->name('customer.properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('customer.properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('customer.properties.store');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('customer.properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('customer.properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('customer.properties.destroy');
    Route::get('/properties/{property}/show', [PropertyController::class, 'showCustomer'])->name('customer.properties.show');
});

// ------------------------------------
// Admin Routes
// ------------------------------------
Route::middleware('isAdmin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/add-user', [UserController::class, 'addUser'])->name('admin.add.user');

    Route::get('/properties', [PropertyController::class, 'indexAdmin'])->name('admin.properties.index');
});

// ------------------------------------
// Broker Routes (If separate)
// ------------------------------------
Route::middleware('isBroker')->prefix('broker')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'brokerDashboard'])->name('broker.dashboard');
});

// ------------------------------------
// House Developer Routes 
// ------------------------------------
Route::middleware('isHouseDeveloper')->prefix('developer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'houseDeveloperDashboard'])->name('developer.dashboard');
});

// ------------------------------------
// Common Authenticated Routes
// ------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/dashboards', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');

    Route::get('/login-history', [UserLoginLogController::class, 'index'])->name('login.history');
});
