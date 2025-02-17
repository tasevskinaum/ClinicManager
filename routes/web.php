<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomePageController;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\SuperAdminMiddleware;
use \Core\Router as Route;

Route::get('/', HomePageController::class, 'index');


// AUTH
Route::get('/login', AuthController::class, 'index', [
    GuestMiddleware::class
]);

Route::post('/login', AuthController::class, 'attempt', [
    GuestMiddleware::class
]);

Route::post('/logout', AuthController::class, 'destroy', [
    AuthMiddleware::class
]);



// ADMIN DASHBOARD
Route::get('/dashboard', AdminDashboardController::class, 'index', [
    AuthMiddleware::class
]);

// ADMIN CRUD
Route::get('/admins', AdminController::class, 'index', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);
Route::get('/admins/create', AdminController::class, 'create', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);
Route::post('/admins/store', AdminController::class, 'store', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);
Route::get('/admins/edit/{user}', AdminController::class, 'edit', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);
Route::post('/admins/update/{user}', AdminController::class, 'update', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);
Route::delete('/admins/destroy/{user}', AdminController::class, 'destroy', [
    AuthMiddleware::class,
    SuperAdminMiddleware::class
]);




// DOCTOR CRUD
Route::get('/doctors', DoctorController::class, 'index', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
Route::get('/doctors/create', DoctorController::class, 'create', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
Route::post('/doctors/store', DoctorController::class, 'store', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
Route::get('/doctors/edit/{user}', DoctorController::class, 'edit', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
Route::post('/doctors/update/{user}', DoctorController::class, 'update', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
Route::delete('/doctors/destroy/{user}', DoctorController::class, 'destroy', [
    AuthMiddleware::class,
    AdminMiddleware::class
]);
