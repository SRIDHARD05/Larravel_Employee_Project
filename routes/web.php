<?php

use Illuminate\Support\Facades\Route;

use App\Models\Employee;

use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;

Route::get('/', [EmployeeController::class, 'welcome'])->name('dashboard');

// Route::prefix('users')->group(function () {
//     Route::get('/', [EmployeeController::class, 'index']);
//     Route::get('/search', [EmployeeController::class, 'search']);
//     Route::get('/templates', [EmployeeController::class, 'templates']);
// });


// Route::get('/user/{id}/{name}', function (string $id, string $name) {
//     return 'User ' . $id. 'Name '. $name;
// })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

// Route::get('/category/{category}', function (string $category) {
//     // ...
// })->whereIn('category', ['movie', 'song', 'painting']);


// Route::get('/', [EmployeeController::class, 'index']);
Route::get('/search', [EmployeeController::class, 'search'])->name('search')->middleware('auth');
Route::get('/templates', [EmployeeController::class, 'templates']);

Route::get('/test', [EmployeeController::class, 'test']);



Route::get('/login', [EmployeeController::class, 'login'])->name('login');
Route::post('/login', [EmployeeController::class, 'login_store']);

Route::get('/register', [EmployeeController::class, 'register'])->name('register');
Route::post('/register', [EmployeeController::class, 'register_store']);

Route::post('/logout', [EmployeeController::class, 'logout'])->name('logout');
