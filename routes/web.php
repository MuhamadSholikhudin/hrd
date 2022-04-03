<?php

use Illuminate\Support\Facades\Route;
use App\Models\HiEmployee;
use App\Models\Employee;
use App\Models\Jon;
use App\Models\Department;

use App\Http\Controllers\JobController;
use App\Http\Controllers\DatamasterEmployeeController;
use App\Http\Controllers\DatamasterPromotionController;
use App\Http\Controllers\DatamasterDemotionController;
use App\Http\Controllers\DatamasterMutationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HiEmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
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

// Route::get('/hi/employees', function () {
//     $employees = Employee::all();
//     return view('hi.employees.index', [ 'employees' => $employees]);
// });



//EXCEL IMPORT END EXPORT
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

//SELECT2 
Route::controller(SearchController::class)->group(function(){
    Route::get('demo-search', 'index');
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});


// JOBS
Route::resource('jobs', JobController::class);

// DEPARTMENTS
Route::resource('departments', DepartmentController::class);


// DATA MASTER EMPLOYEES
Route::resource('datamaster/employees', DatamasterEmployeeController::class);

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(EmployeeController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportemployees', 'export')->name('users.export');
    Route::post('importemployees', 'import')->name('employees.import');
    Route::post('updateemployees', 'update')->name('employees.update');
});

// DATA MASTER PROMOTION
Route::resource('datamaster/promotions', DatamasterPromotionController::class);


// DATA MASTER DEMOTION
Route::resource('datamaster/demotions', DatamasterDemotionController::class);


// DATA MASTER MUTATION
Route::resource('datamaster/mutations', DatamasterMutationController::class);


Route::get('/hi', function () {
    return view('hi.employees');
});

// Route::resource('/hi/employees', HiEmployeeController::class);

// Route::resource('/hi/investigations', HiEmployeeController::class);