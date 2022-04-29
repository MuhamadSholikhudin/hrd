<?php

use Illuminate\Support\Facades\Route;

// Models Data master
use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;

//Model Hi
use App\Models\HiEmployee;
use App\Models\Paragraph;
use App\Models\Article;
use App\Models\Alphabet;

use App\Http\Controllers\LoginController;

//Controller Datamaster
use App\Http\Controllers\JobController;
use App\Http\Controllers\DatamasterEmployeeController;
use App\Http\Controllers\DatamasterPromotionController;
use App\Http\Controllers\DatamasterDemotionController;
use App\Http\Controllers\DatamasterMutationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExcelPromotionController;
use App\Http\Controllers\ExcelDemotionController;
use App\Http\Controllers\ExcelMutationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HiEmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

// Controller HI
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\HiViolationController;
use App\Http\Controllers\LayoffController;
use App\Http\Controllers\HiPkbController;
use App\Http\Controllers\HiArticleController;
use App\Http\Controllers\HiParagraphController;
use App\Http\Controllers\HiAlphabetController;
use App\Http\Controllers\SignatureController;



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



Route::get('/example', function () {
    return view('example');
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

Route::get('/datamaster/promotions/{promotions:id}/getedit', [DatamasterPromotionController::class, 'getedit']);

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelPromotionController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportpromotions', 'export')->name('promotions.export');
    Route::post('importpromotions', 'import')->name('promotions.import');
    Route::post('updatepromotions', 'update')->name('promotions.update');
});

// DATA MASTER DEMOTION
Route::resource('datamaster/demotions', DatamasterDemotionController::class);

Route::get('/datamaster/demotions/{demotions:id}/getedit', [DatamasterDemotionController::class, 'getedit']);

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelDemotionController::class)->group(function(){
    Route::get('exportdemotions', 'export')->name('demotions.export');
    Route::post('importdemotions', 'import')->name('demotions.import');
    Route::post('updatedemotions', 'update')->name('demotions.update');
});

// DATA MASTER MUTATION
Route::resource('datamaster/mutations', DatamasterMutationController::class);

Route::get('/datamaster/mutations/{demotions:id}/getedit', [DatamasterMutationController::class, 'getedit']);

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelMutationController::class)->group(function(){
    Route::get('exportmutations', 'export')->name('mutations.export');
    Route::post('importmutations', 'import')->name('mutations.import');
    Route::post('updatemutations', 'update')->name('mutations.update');
});


// DATA HI Violations
Route::resource('hi/violations', ViolationController::class);

Route::get('/violations/list', [ViolationController::class, 'list']);

Route::resource('hi/hiviolations', HiViolationController::class);

Route::controller(HiViolationController::class)->group(function(){
    Route::get('exportviolations', 'export')->name('violations.export');
    Route::post('importviolations', 'import')->name('violations.import');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

Route::post('violation/get_type_violation', [ViolationController::class, 'get_type_violation'])->name('get_type_violation');

// Route::get('/hi', function () {
//     return view('hi.employees');
// });

// PKB
Route::resource('/hi/pkb', HiPkbController::class);

// PKB -> articles
Route::resource('/hi/articles', HiArticleController::class);

// PKB -> paragraphs
Route::resource('/hi/paragraphs', HiParagraphController::class);

// PKB -> alphabets
Route::resource('/hi/alphabets', HiAlphabetController::class);

//EXCEL IMPORT END EXPORT VIOLATIONS
Route::controller(HiAlphabetController::class)->group(function(){
    Route::get('exportalphabets', 'export')->name('alphabets.export');
    Route::post('importalphabets', 'import')->name('alphabets.import');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

// SIGNATURES
Route::resource('/hi/signatures', SignatureController::class);
Route::post('signatures/get_type_violation', [SignatureController::class, 'get_signature'])->name('get_signature');


// LAYOFFS
Route::resource('/hi/layoffs', LayoffController::class);

Route::post('layoffs/get_karyawan_phk', [LayoffController::class, 'get_karyawan_phk'])->name('get_karyawan_phk');

Route::get('layoffs/karyawan_phk', [LayoffController::class, 'karyawan_phk'])->name('karyawan_phk');

Route::post('layoffs/get_pasal_phk', [LayoffController::class, 'get_pasal_phk'])->name('get_pasal_phk');

// LOGIN AUTHENTICATION
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);


