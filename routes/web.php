<?php

use Illuminate\Support\Facades\Route;

use App\Models\Employee;


use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index']);

Route::get('/search', [EmployeeController::class, 'search']);