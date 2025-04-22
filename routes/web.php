<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, AuthController, DashboardController, UserController,
    UserLoginLogController, UserProfileController, PropertyController, VehicleController, DirectoryController,
    CallController
};

// ------------------------------------
// Public Routes
// ------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home-search', [HomeController::class, 'search'])->name('home-search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

// ------------------------------------
// Login and Registration Routes
// ------------------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------
// Authenticated User Routes
// ------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Properties
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property:slug}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/properties/{property:slug}/show', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
    Route::get('/properties/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my-properties');
    Route::get('/properties/show-all/{id}', [PropertyController::class, 'showAll'])->name('properties.show-all');

    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    Route::get('/vehicles/{vehicle:slug}/show', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicles/search', [VehicleController::class, 'search'])->name('vehicles.search');
    Route::get('/vehicles/my-vehicles', [VehicleController::class, 'myVehicles'])->name('vehicles.my-vehicles');
    Route::get('/vehicles//show-all/{id}', [VehicleController::class, 'showAll'])->name('vehicles.show-all');

    // Directory
    Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
    Route::get('/directory/create', [DirectoryController::class, 'create'])->name('directory.create');
    Route::post('/directory', [DirectoryController::class, 'store'])->name('directory.store');
    Route::get('/directory/{directory}/edit', [DirectoryController::class, 'edit'])->name('directory.edit');
    Route::put('/directory/{directory}', [DirectoryController::class, 'update'])->name('directory.update');
    Route::delete('/directory/{directory}', [DirectoryController::class, 'destroy'])->name('directory.destroy');
    Route::get('/directory/{directory}/show', [DirectoryController::class, 'show'])->name('directory.show');
    Route::get('/directory/search', [DirectoryController::class, 'search'])->name('directory.search');
    Route::get('/directory/my-directories', [DirectoryController::class, 'myDirectories'])->name('directory.my-directories');
    Route::get('/directory/show-all/{id}', [DirectoryController::class, 'showAll'])->name('directory.show-all');

    // Calls
    Route::get('/calls/my-calls', [CallController::class, 'myCalls'])->name('calls.my-calls');
    Route::get('/calls/create', [CallController::class, 'create'])->name('calls.create');
    Route::post('/calls', [CallController::class, 'store'])->name('calls.store');
    Route::get('/calls/search', [CallController::class, 'search'])->name('calls.search');
    
    // User
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}/show', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/login-history', [UserLoginLogController::class, 'index'])->name('login.history');
    Route::get('/my-login-history', [UserLoginLogController::class, 'myIndex'])->name('my-login.history');
});

// ------------------------------------
// Admin Routes
// ------------------------------------
Route::middleware('isAdmin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    // Change User Role
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('admin.users.search');
    Route::get('/users/{id}/change-role', [UserController::class, 'editRole'])->name('admin.users.edit-role');
    Route::post('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('admin.users.update-role');
    // Calls
    Route::get('/calls', [CallController::class, 'index'])->name('admin.calls.index');
    Route::get('/calls/properties', [CallController::class, 'propertyCalls'])->name('admin.calls.property');
    Route::get('/calls/vehicles', [CallController::class, 'vehicleCalls'])->name('admin.calls.vehicle');
    Route::get('/calls/directories', [CallController::class, 'directoryCalls'])->name('admin.calls.directory');
});

// ------------------------------------
// Customer Routes
// ------------------------------------
Route::middleware('isCustomer')->prefix('customer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');

    
});

// ------------------------------------
// Employee Routes
// ------------------------------------
Route::middleware('isEmployee')->prefix('employee')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');

    // Calls
    Route::get('/calls', [CallController::class, 'employeeCalls'])->name('employee.calls.index');
    Route::get('/calls/properties', [CallController::class, 'employeePropertyCalls'])->name('employee.calls.property');
    Route::get('/calls/vehicles', [CallController::class, 'employeeVehicleCalls'])->name('employee.calls.vehicle');
    Route::get('/calls/directories', [CallController::class, 'employeeDirectoryCalls'])->name('employee.calls.directory');

    //Call Progress
    Route::post('/calls/progress', [CallController::class, 'callProgress'])->name('employee.calls.progress');
    

});

