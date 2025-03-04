<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', [EmployeeController::class, 'welcome'])->name('dashboard');
Route::get('/search', [EmployeeController::class, 'search'])->name('search')->middleware('auth');
Route::get('/templates', [EmployeeController::class, 'templates']);

Route::get('/test', [EmployeeController::class, 'test']);

Route::get('/login', [EmployeeController::class, 'login'])->name('login');
Route::post('/login', [EmployeeController::class, 'login_store']);

Route::get('/register', [EmployeeController::class, 'register'])->name('register');
Route::post('/register', [EmployeeController::class, 'register_store']);

Route::post('/logout', [EmployeeController::class, 'logout'])->name('logout');



// Route::middleware(['auth', 'admin'])->group(function () {

//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

// Route::get('/errors/403', function () {
//     return view('errors.403');
// })->name('errors.403');
