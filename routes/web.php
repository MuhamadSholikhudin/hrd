<?php

use Illuminate\Support\Facades\Route;
use App\Models\HiEmployee;
use App\Http\Controllers\HiEmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//HRD IT
Route::get('/hi', function () {
    return view('hi.employees');
});

// Route::get('/hi/employees', function () {
//     $employees = Employee::all();
//     return view('hi.employees.index', [ 'employees' => $employees]);
// });

Route::resource('/hi/employees', HiEmployeeController::class);

Route::resource('/hi/investigations', HiEmployeeController::class);
